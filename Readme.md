# Swap Dero -> Monero

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

In the dero's folder, launch the daemon in testnet mode. <br>
Then, create two wallet. One called wallet_service, the other one wallet_user
<pre>
# In a terminal (this one always runs)
./derod --testnet

# In another terminal
./dero-wallet-cli --testnet --generate-new-wallet wallet_service
./dero-wallet-cli --testnet --generate-new-wallet wallet_user
# currently the argument --generate-new-wallet doesn't work, create wallets manually
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

### Fill the wallets
The user send dero to the service <br>
Then the service send monero to user <br>

So let's fill two wallets: <br> 
wallet_user (dero) and wallet_service (monero)

https://community.xmr.to/faucet/stagenet <br>
For dero, register your new account on testnet

### Start the service
Terminal 1: run the dero daemon
<pre>
derod --testnet
</pre>

Terminal 2: run the dero wallet user
<pre>
dero-wallet-cli --testnet --wallet-file=wallet_user
</pre>

Terminal 3: run the dero wallet service
<pre>
dero-wallet-cli --testnet --rpc-server --wallet-file=wallet_user
</pre>

Terminal 4: run the monero daemon in stagenet
<pre>
monerod --stagenet
</pre>

Terminal 5: run the monero wallet user
<pre>
monero-wallet-cli --stagenet --wallet-file=wallet_user
</pre>

Terminal 6: run the monero wallet service
<pre>
monero-wallet-rpc.exe --rpc-bind-ip=127.0.0.1 --rpc-bind-port=38083 --disable-rpc-login --log-level=3 --wallet-file=wallet_service --prompt-for-password --stagenet
</pre>

### Do some test 

Send dero from wallet_user to wallet_service.

Terminal 7:
<pre>
cd poc_swap_xmr_dero

# prepare a transaction dero -> monero
php bin/swap-cli

# prepare a transaction monero -> dero
php bin/swap-cli

# run the swap
php bin/swap.exe
</pre>

Should return: We have receided the dero and sent your monero

### Warning
Do not test in any mainnet.

###### Thanks
Dero address: dERirD3WyQi4udWH7478H66Ryqn3syEU8bywCQEu3k5ULohQRcz4uoXP12NjmN4STmEDbpHZWqa7bPRiHNFPFgTBPmcBpfpJaKT8nKPXJx1Qt



