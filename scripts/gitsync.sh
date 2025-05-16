#!/data/data/com.termux/files/usr/bin/bash

echo "🔄 Syncing with GitHub..."

# Pull latest changes from GitHub
git pull origin main

# Add all new/changed files
git add .

# Prompt for commit message
echo -n "📝 Enter commit message: "
read msg

# Commit with message
git commit -m "$msg"

# Push to GitHub
git push origin main

echo "✅ Sync complete!"
