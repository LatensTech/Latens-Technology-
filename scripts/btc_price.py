#!/data/data/com.termux/files/usr/bin/python

import requests
import datetime
import os

url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd"

try:
    response = requests.get(url)
    data = response.json()
    price = data["bitcoin"]["usd"]

    now = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    message = f"[{now}] BTC Price: ${price}"
    print(message)

    # Save to log
    with open("/data/data/com.termux/files/home/latens-lab/logs/btc_price.log", "a") as file:
        file.write(message + "\n")

    # Send phone notification
    os.system(f'termux-notification --title "BTC Update" --content "{message}"')

except Exception as e:
    error_msg = f"[ERROR] {e}"
    print(error_msg)
