README.txt

2014 Mobile Web Front End Development College Intern position - Challenge

by Ashley Montgomery / aemontgomery756@gmail.com

This application (Price Notify) utilizes the Zappo's search API to allow
users (registered and logged in) to select items from the Zappo's store
and add them to their Price Notify List. Once an item is added, if the 
price of that item goes below 20% off, the user will be emailed saying
that the item is on sale. This email will also provide the item's 
zappos.com link so that the user can opt to visit zappos.com and purchase
the item.

Hosted on my Amazon EC2 Linux instance:
http://ec2-54-85-7-160.compute-1.amazonaws.com/~amont/zappos_price_notify/html/login.html

________________________________________________________________________________
User Login and Registration:

User data (name, email, encrypted password) are stored in a MySql table 'users' 
inside the MySql database 'price_notifier'. Users can't use an email address 
more than once to register. 

Price watch adds are stored in a MySql table 'watches' inside the 'price_notifier'
database as well. This table stores data such as the thumbnail link, item name,
original price, current price, zappos.com url, etc. so that the 'My List' page can 
recall this information easily without having to make an API request. Price watches
are associated with user IDs and emails from the 'users' table.

________________________________________________________________________________
Notes:

Due to 401 error when making a request on the Zappo's API, /php/searchZappos.php
has 2 versions of a url to use. The commented out version will retrieve accurate
results from the Zappo's search API. 

The current version looks at /php/vansSearch.txt
which contains sample API response for a "vans" keyword search. Unless the urls are
switched, the search functionality of the app will always return the reselts from
the /php/vansSearch.txt file. 

Additionally, /php/checkPriceDrop.php will request JSON data from the Zappo's API
and compare the original price stored in the MySql database with the current
price from the API and then it will send an email to the users signed up to watch that
item. 

*cron job will run the /php/checkPriceDrop.php every hour to check for an accurate
current price

0 0 * * * /home/amont/public_html/zappos_price_notifier/php/checkPriceDrop.php

/php/checkPriceDropVans.php will perform the same functionality but again, it looks
at the sample JSON data from the /php/vansSearch.txt file instead of real data from 
the Zappo's API.


________________________________________________________________________________
Areas to Expand:

- More messages to allow user to know what the application is doing (e.g.
	if the login fails, explain why it failed, etc.)

- "Guest" functionality - users don't have to sign up for accounts in order
	to search for products or receive emails when items go on sale. Potentially,
	users can just begin by searching and if they aren't logged in, they will be
	prompted to log in, register, or input email as a guest. As a guest, they won't
	have their specific "My List" page but they will receive emails about items
	that they signed up for. 

- Pagination of search results so that users can find the exact item that they want

- Information pages on items

- Quick add - doesn't take user away from search results page, just adds item to their
	watch list.
