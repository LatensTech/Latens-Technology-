#!/data/data/com.termux/files/usr/bin/bash

cd ~/latens-lab || exit

echo "🔄 Syncing with GitHub..."

git pull origin Master

git add .

echo -n "📝 Enter commit message: "
read msg

git commit -m "$msg"

git push origin Master

echo "✅ Sync complete!"
