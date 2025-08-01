# 🌌 Universe: Daily Secrets for Termux

**Universe** is a simple motivational quote delivery system for Termux users. It sends an inspiring notification every hour using preloaded quotes — no internet needed.

## 📦 What’s Inside?

- `secrets.py` – Python script that sends a quote using Termux notification.
- `dailysecrets.txt` – A file with 100+ secrets from the universe.
- `install.sh` – One-click setup script that configures everything.

## ⚙️ Installation

1. Clone the repo:

   ```bash
   git clone https://github.com/LatensTech/Universe.git
   cd Universe

2. Run the install script:

bash install.sh

This will:

Move the Universe folder to ~/latens-lab/

Set up aliases for quick access

Enable and configure crond to run every hour

Trigger the first quote to test

🚀 Usage

After setup, the quotes will appear every hour automatically as notifications.

You can also manually run it anytime:

secrets

📝 Customize

To add or change quotes, edit:


nano ~/latens-lab/Universe/dailysecrets.txt

Each quote should be on a separate line.

🙌 Credits


~Crafted with love and ambition in the lab.


---
