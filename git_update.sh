#!/bin/bash

# Laravel Docker Semantic Versioning Script
# Usage: ./git_update.sh -v [major|minor|patch]

VERSION=""
# get parameters
while getopts v: flag
do
  case "${flag}" in
    v) VERSION=${OPTARG};;
    *) echo "Invalid option"; exit 1;;
  esac
done

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

print_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

print_info "Starting semantic versioning for Laravel Docker deployment..."

# Ensure we're in a git repository
if ! git rev-parse --git-dir > /dev/null 2>&1; then
    print_error "This directory is not a git repository"
    exit 1
fi

# Fetch the latest tags and commits
print_info "Fetching latest tags and commits..."
git fetch --prune --unshallow 2>/dev/null || git fetch --prune

# Get the highest tag number
CURRENT_VERSION=$(git tag | grep '^v[0-9]' | sort -V | tail -n 1)

if [[ -z "$CURRENT_VERSION" ]]; then
  CURRENT_VERSION='v0.1.0'
  print_warning "No existing version tags found, starting with $CURRENT_VERSION"
else
  print_info "Current Version: $CURRENT_VERSION"
fi

# Strip the 'v' prefix and split into parts
VERSION_NUM=${CURRENT_VERSION#v}
IFS='.' read -r -a VERSION_PARTS <<< "$VERSION_NUM"

# Validate version parts
if [ ${#VERSION_PARTS[@]} -ne 3 ]; then
    print_error "Invalid version format: $CURRENT_VERSION. Expected format: v1.2.3"
    exit 1
fi

# Get number parts
VNUM1=${VERSION_PARTS[0]}
VNUM2=${VERSION_PARTS[1]}
VNUM3=${VERSION_PARTS[2]}

# Validate that version parts are numbers
if ! [[ "$VNUM1" =~ ^[0-9]+$ ]] || ! [[ "$VNUM2" =~ ^[0-9]+$ ]] || ! [[ "$VNUM3" =~ ^[0-9]+$ ]]; then
    print_error "Version parts must be numbers: $VNUM1.$VNUM2.$VNUM3"
    exit 1
fi

print_info "Current version parts: Major=$VNUM1, Minor=$VNUM2, Patch=$VNUM3"

# Increment version number based on the type
case "$VERSION" in
  major)
    VNUM1=$((VNUM1 + 1))
    VNUM2=0
    VNUM3=0
    print_info "Incrementing MAJOR version (breaking changes)"
    ;;
  minor)
    VNUM2=$((VNUM2 + 1))
    VNUM3=0
    print_info "Incrementing MINOR version (new features, backward compatible)"
    ;;
  patch)
    VNUM3=$((VNUM3 + 1))
    print_info "Incrementing PATCH version (bug fixes, backward compatible)"
    ;;
  *)
    print_error "No version type (https://semver.org/) or incorrect type specified"
    print_error "Usage: $0 -v [major|minor|patch]"
    print_info "  major: Breaking changes (1.0.0 -> 2.0.0)"
    print_info "  minor: New features, backward compatible (1.0.0 -> 1.1.0)"
    print_info "  patch: Bug fixes, backward compatible (1.0.0 -> 1.0.1)"
    exit 1
    ;;
esac

# Create new tag
NEW_TAG="v$VNUM1.$VNUM2.$VNUM3"
print_info "($VERSION) updating $CURRENT_VERSION to $NEW_TAG"

# Get current hash and see if it already has a tag
GIT_COMMIT=$(git rev-parse HEAD)
NEEDS_TAG=$(git describe --contains "$GIT_COMMIT" 2>/dev/null)

# Only tag if no tag already exists on this commit
if [ -z "$NEEDS_TAG" ]; then
    print_info "Creating and pushing new tag: $NEW_TAG"

    # Create annotated tag with message
    git tag -a "$NEW_TAG" -m "Release $NEW_TAG - Laravel Docker Image"

    # Push tag and current branch
    if git push --tags && git push; then
        print_success "Tagged with $NEW_TAG and pushed to remote"
    else
        print_error "Failed to push tag to remote repository"
        exit 1
    fi
else
    print_warning "Already a tag on this commit: $(git describe --tags --exact-match "$GIT_COMMIT" 2>/dev/null)"
    # Use the existing tag
    NEW_TAG=$(git describe --tags --exact-match "$GIT_COMMIT" 2>/dev/null)
fi

# Output the tag for GitHub Actions
echo "git-tag=$NEW_TAG" >> $GITHUB_ENV
echo "version-number=${NEW_TAG#v}" >> $GITHUB_ENV
echo "major-version=$VNUM1" >> $GITHUB_ENV
echo "minor-version=$VNUM2" >> $GITHUB_ENV
echo "patch-version=$VNUM3" >> $GITHUB_ENV

print_success "Semantic versioning completed successfully!"
print_info "New version: $NEW_TAG"
print_info "This will trigger Docker image build and push to DockerHub"

exit 0
