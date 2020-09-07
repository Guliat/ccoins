Cryptocurrencies Portfolio Watchlist
Version naming - Versions.Updates.Fixes <br />
---
0.1.0 -  22.08.2020:AM - Install Fresh Laravel 7.25 <br />
0.2.0 -  23.08.2020:AM - Add Bulma CSS Framework from CDN, first changes on defualt Welcome Page <br />
0.3.0 -  23.08.2020:AM - Split default welcome page to head, main, welcome <br />
0.4.0 -  23.08.2020:AM - Make 'Coins' (MVCMR) Model, Views, Controller, Migration, Routes <br />
0.5.0 -  23.08.2020:AM - Make 'Exchanges' (MVCMR) Model, Views, Controller, Migration, Routes <br />
Fix 1 -  23.08.2020:AM - Fix Trades migration -> nullable(open, close prices) <br />
0.6.1 -  23.08.2020:AM - Make 'Trades' (MVCMR) Model, Views, Controller, Migration, Routes <br />
0.7.1 -  23.08.2020:PM - Add Bulma, Bulma tooltip, Bulma Badge (Yarn), FontAwesome 5.2 (web) <br />
0.8.1 -  24.08.2020:AM - Add Buefy, VueJS (Yarn) <br />
Fix 2 -  24.08.2020:PM - Fix extra quote in undelete-form-action <br />
0.9.2 -  24.08.2020:PM - Add 'Coins' (mVCmR) first functions and design <br />
0.10.2 - 24.08.2020:PM - Add Toasts for Add, Update, Delete, Undelete <br />
0.11.2 - 24.08.2020:PM - Add 'Exchanges' (mVCmR) first functions and design <br />
0.12.2 - 26.08.2020:PM - Add CoinGecko API (Composer) <br />
0.13.2 - 26.08.2020:PM - Add 'Trades' (MVCMR) first functions and design (run migration) <br />
Version 1
1.14.2 - 26.08.2020:PM - Add Navbar, changes in Welcome page <br />
1.15.2 - 28.08.2020:PM - Add "PerCoins" View (cards), Controller, Model <br />
1.16.2 - 28.08.2020:PM - Changes in Navbar (burger fix (script)) and Welcome Page <br />
1.17.2 - 29.08.2020:AM - Work on "close trade",changes in active_trade view, migration (close_quantity), close_trade function, etc. (run migration) <br />
 Fix 3 - Change "steps" from 6 to 8 in number inputs when close trade <br />
1.18.3 - 29.08.2020:PM - Add Laravel errors views and change design a little <br />
1.19.3 - 29.08.2020:PM - Add Authentication, controllers, views, changes in design to work with it. (must run composer)<br />
1.20.3 - 30.08.2020:AM - Add current price in coins.index <br />
1.21.3 - 30.08.2020:AM - Add coin symbol for autocomplete search in trades.create <br />
 Fix 4 - 30.08.2020:PM - Explode coin name from symbol when submit trades.create (controller) <br />
 Fix 5 - 30.08.2020:PM - Change 'quantity' to 'close quantity' in closed trades view <br />
1.22.5 - 31.08.2020:PM - Add convert to Bitcoin functions in trades (mVCMR) (run migration ) <br />
 Fix 6 - 31.08.2020:PM - Fix extra quote from sell and convert forms in trades.active <br />
 Fix 7 - 31.08.2020:PM - Fix Profit in closed trades view <br />
1.23.7 - 01.09.2020:PM - Add referal_trade_id migration, change view trades.active, change model Trades (run migration)<br />
 Fix 8 - 01.09.2020:PM - Fix trades.active (if there referal trade), add referal_trade to controller.convert <br />
1.24.8 - 01.09.2020:PM - Add "total quantity" on active trades in coins.index <br />
Version 2
2.24.8 - 06-07.09.2020 - Split all.coins_exchanges to user.coins_exchanges, make manage pages (coins, exchanges), remove buefy styles (override bulma problem), change navbar to admin / user styles, add coin price in database + update price (cron must be add to server), clear unused routes and functions from controllers, etc... <br />
 Fix 9 - 07.09.2020:PM - Fix manage routes "manage.... to Manage...."
2.25.9 - 07.09.2020:PM - Add coin symbol to autocomplete in coins.create 
-
Version 1.14.2 - First fully functional version (must work :D - NOT TESTED with pulling, etc.) <br />
EDIT (1.14.2) - Tested on Ubuntu with nginx - It Works. <br />