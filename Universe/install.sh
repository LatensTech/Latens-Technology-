#!/data/data/com.termux/files/usr/bin/bash

# Set up paths
BASE_DIR="$HOME/LatensTech/Universe"
SCRIPT="$BASE_DIR/secrets.py"
QUOTE_FILE="$BASE_DIR/dailysecrets.txt"
CRON_JOB="0 * * * * /data/data/com.termux/files/usr/bin/python $SCRIPT"
ALIAS_CMD="alias dailysecret='python $SCRIPT'"

# 1. Ensure correct location
mkdir -p "$BASE_DIR"

# 2. Make sure script is executable
chmod +x "$SCRIPT"

# 3. Setup alias in ~/.bashrc or ~/.zshrc
SHELL_RC="$HOME/.bashrc"
[ -n "$ZSH_VERSION" ] && SHELL_RC="$HOME/.zshrc"

if ! grep -q "alias dailysecret=" "$SHELL_RC"; then
    echo "$ALIAS_CMD" >> "$SHELL_RC"
    echo "[+] Alias 'dailysecret' added to $SHELL_RC"
else
    echo "[✓] Alias already exists in $SHELL_RC"
fi

# 4. Install crond if not present
pkg install -y cronie >/dev/null 2>&1

# 5. Start crond
crond

# 6. Add cron job if not already there
crontab -l | grep -q "$SCRIPT"
if [ $? -ne 0 ]; then
    (crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -
    echo "[+] Cron job installed to run every hour"
else
    echo "[✓] Cron job already exists"
fi

# 7. Run once immediately
echo "[*] Sending your first quote now..."
python "$SCRIPT"

# 8. Done
echo -e "\n🎉 Installation complete!"
echo "🔁 A new quote will appear every hour via notification"
echo "💡 You can also run 'dailysecret' manually anytime."
