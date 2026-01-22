#!/bin/bash

# Shiva Shine - Pre-Deployment Verification Script
# Run this before deploying to Render to verify configuration

echo "=========================================="
echo "  Shiva Shine - Deployment Verification  "
echo "=========================================="
echo ""

# Color codes
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Counters
PASSED=0
FAILED=0
WARNINGS=0

# Check function
check() {
    if [ $1 -eq 0 ]; then
        echo -e "${GREEN}✓${NC} $2"
        ((PASSED++))
    else
        echo -e "${RED}✗${NC} $2"
        ((FAILED++))
    fi
}

warn() {
    echo -e "${YELLOW}⚠${NC} $1"
    ((WARNINGS++))
}

echo "Checking required files..."
echo ""

# Check Docker files
[ -f "Dockerfile" ] && check 0 "Dockerfile exists" || check 1 "Dockerfile missing"
[ -f "docker-entrypoint.sh" ] && check 0 "docker-entrypoint.sh exists" || check 1 "docker-entrypoint.sh missing"
[ -x "docker-entrypoint.sh" ] && check 0 "docker-entrypoint.sh is executable" || warn "docker-entrypoint.sh may need execute permissions"

# Check configuration files
[ -f "render.yaml" ] && check 0 "render.yaml exists" || check 1 "render.yaml missing"
[ -f ".env.example" ] && check 0 ".env.example exists" || check 1 ".env.example missing"
[ -f "composer.json" ] && check 0 "composer.json exists" || check 1 "composer.json missing"
[ -f "package.json" ] && check 0 "package.json exists" || check 1 "package.json missing"

echo ""
echo "Checking render.yaml configuration..."
echo ""

# Check render.yaml for required environment variables
if [ -f "render.yaml" ]; then
    grep -q "DB_CONNECTION" render.yaml && check 0 "DB_CONNECTION configured" || check 1 "DB_CONNECTION missing"
    grep -q "DB_HOST" render.yaml && check 0 "DB_HOST configured" || check 1 "DB_HOST missing"
    grep -q "DB_PASSWORD" render.yaml && check 0 "DB_PASSWORD configured" || check 1 "DB_PASSWORD missing"
    grep -q "APP_URL" render.yaml && check 0 "APP_URL configured" || check 1 "APP_URL missing"
    
    # Check for placeholder values
    grep -q "your-database-host" render.yaml && warn "render.yaml contains placeholder values - update before deploying"
    grep -q "your_email@gmail.com" render.yaml && warn "Email configuration contains placeholders"
fi

echo ""
echo "Checking Laravel configuration..."
echo ""

# Check Laravel directories
[ -d "app" ] && check 0 "app/ directory exists" || check 1 "app/ directory missing"
[ -d "config" ] && check 0 "config/ directory exists" || check 1 "config/ directory missing"
[ -d "database" ] && check 0 "database/ directory exists" || check 1 "database/ directory missing"
[ -d "routes" ] && check 0 "routes/ directory exists" || check 1 "routes/ directory missing"

# Check storage permissions
if [ -d "storage" ]; then
    check 0 "storage/ directory exists"
    [ -w "storage" ] && check 0 "storage/ is writable" || warn "storage/ may need write permissions"
fi

if [ -d "bootstrap/cache" ]; then
    check 0 "bootstrap/cache/ exists"
    [ -w "bootstrap/cache" ] && check 0 "bootstrap/cache/ is writable" || warn "bootstrap/cache/ may need write permissions"
fi

echo ""
echo "Checking Git status..."
echo ""

# Check if git is initialized
if [ -d ".git" ]; then
    check 0 "Git repository initialized"
    
    # Check for uncommitted changes
    if git diff-index --quiet HEAD -- 2>/dev/null; then
        check 0 "No uncommitted changes"
    else
        warn "You have uncommitted changes - commit before deploying"
    fi
    
    # Check remote
    if git remote -v | grep -q "origin"; then
        check 0 "Git remote configured"
    else
        check 1 "Git remote not configured"
    fi
else
    check 1 "Git repository not initialized"
fi

echo ""
echo "Security checks..."
echo ""

# Check .gitignore
if [ -f ".gitignore" ]; then
    check 0 ".gitignore exists"
    grep -q "^\.env$" .gitignore && check 0 ".env is in .gitignore" || warn ".env should be in .gitignore"
else
    warn ".gitignore missing"
fi

# Check if .env is committed (it shouldn't be)
if [ -d ".git" ]; then
    if git ls-files | grep -q "^\.env$"; then
        warn ".env file is tracked by git (security risk!)"
    else
        check 0 ".env is not tracked by git"
    fi
fi

echo ""
echo "=========================================="
echo "           Verification Summary          "
echo "=========================================="
echo -e "${GREEN}Passed:${NC}   $PASSED"
echo -e "${YELLOW}Warnings:${NC} $WARNINGS"
echo -e "${RED}Failed:${NC}   $FAILED"
echo ""

if [ $FAILED -eq 0 ] && [ $WARNINGS -eq 0 ]; then
    echo -e "${GREEN}✓ All checks passed! Ready to deploy.${NC}"
    exit 0
elif [ $FAILED -eq 0 ]; then
    echo -e "${YELLOW}⚠ Checks passed with warnings. Review warnings before deploying.${NC}"
    exit 0
else
    echo -e "${RED}✗ Some checks failed. Please fix issues before deploying.${NC}"
    exit 1
fi
