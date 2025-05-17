#!/data/data/com.termux/files/usr/bin/python

import requests
import subprocess
import random

def get_quote():
    try:
        res = requests.get("https://api.quotable.io/random")
        if res.status_code == 200:
            data = res.json()
            return f'"{data["content"]}" — {data["author"]}'
        else:
            return "Be patient. Everything comes to you at the right moment."
    except:
        fallback_quotes = [
            "Push yourself, because no one else is going to do it for you.",
            "Success is the sum of small efforts, repeated day in and day out.",
            "The best time to start was yesterday. The next best is now.",
        ]
        return random.choice(fallback_quotes)

def send_notification(message):
    subprocess.run([
        "termux-notification",
        "--title", "Daily Quote",
        "--content", message,
        "--priority", "high"
    ])

if __name__ == "__main__":
    quote = get_quote()
    send_notification(quote)
