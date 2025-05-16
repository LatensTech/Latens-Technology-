#!/data/data/com.termux/files/usr/bin/bash

cd ~/latens-lab || exit

echo "🔄 Syncing with GitHub..."

git pull origin main

git add .

echo -n "📝 Enter commit message: "
read msg

git commit -m "$msg"

git push origin main

echo "✅ Sync complete!"
