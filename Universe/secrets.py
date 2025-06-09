#!/data/data/com.termux/files/usr/bin/python

import subprocess
import random
import os

QUOTE_FILE = os.path.expanduser("~/latens-lab/Universe/dailysecrets.txt")

def get_random_quote():
    try:
        with open(QUOTE_FILE, "r") as f:
            quotes = [line.strip() for line in f if line.strip()]
        return random.choice(quotes)
    except:
        return "Keep going. Your future self will thank you."

def add_flair(quote):
    flair = random.choice(["🌟", "🔥", "🧠", "💭", "📜", "✨", "💡", "🛸"])
    return f"{flair} {quote}"

def get_dynamic_title():
    return random.choice([
        "💬 Morning Wisdom",
        "🎯 Daily Push",
        "🧘 Focus Mode",
        "⚡ Power Byte",
        "🧠 Mind Spark",
        "🌅 Rise & Grind"
    ])

def send_notification(message, title):
    subprocess.run([
        "termux-notification",
        "--title", title,
        "--content", message,
        "--priority", "high"
    ])

if __name__ == "__main__":
    quote = get_random_quote()
    message = add_flair(quote)
    title = get_dynamic_title()
    send_notification(message, title)
