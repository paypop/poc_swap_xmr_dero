# Swap XMR -> DERO

## [dARCH 2021 Event 0.5 — Services Only](https://medium.com/deroproject/darch-2021-event-0-5-services-only-44a8587a3511)

### Required

- php 7.2+
- composer
- monero 
- dero
- postman or insomnia

### Install

In a first terminal, clone the repository's folder
<pre>
git clone https://github.com/netwarp/poc_swap_xmr_dero
cd poc_swap_xmr_dero
cp .env.example .env
composer install
</pre>

In the monero's folder, launch the daemon in stagenet mode. <br>
Then, create two wallet. One called wallet_service, the other one wallet_user
<pre>
# In a terminal (this one always runs)
./monerod --stagenet

# In another terminal
./monero-wallet-cli --stagenet --generate-new-wallet wallet_service
./monero-wallet-cli --stagenet --generate-new-wallet wallet_user
</pre>

In the dero's folder, launch the daemon in testnet. <br>
Then, create two wallets. One called wallet_service, the other one wallet_user
<pre>
# In one terminal (this one always runs)
./derod --testnet # depending of your system the program's name is not the same

# In another terminal, 
./dero-wallet-cli --generate-new-wallet wallet_service
./dero-wallet-cli --generate-new-wallet wallet_user
# currently the argument --generate-new-wallet doesn't work, create wallets manually
</pre>

### Fill the wallets

The user send monero to the service. <br>
Then the service send dero to user. <br>
So let's fill two wallets: <br> 
wallet_user (monero) and wallet_service (dero)

https://community.xmr.to/faucet/stagenet <br>
For dero, ask to the community to fill your testnet's wallet

### Start the service
<pre>
monero-wallet-rpc.exe --rpc-bind-ip=127.0.0.1 --rpc-bind-port=38083 --disable-rpc-login --log-level=3 --wallet-file=wallet_service --prompt-for-password --stagenet --tx-notify="<b>/absolute/path/to/php /absolute/path/poc_swap_xmr_dero/index.php %s</b>"
</pre>