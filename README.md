# getAccountBalance
Get Seller or Buyer account Balance via API

Prior to development we just login as a seller and go to live calls.
Select to search for prefix 9 and press search.
Now let us do the same request result via API so we take a URL (L in the end) from browser:

Example

http://developer.telecomsxchange.com/v_livecalls.php?like=is+like&prefix=9&show=all


n this example current request uri is as follows, let us call it "original request uri": 

/v_livecalls.php?like=is+like&amp;prefix=9&amp;show=all

Now to create an API call similar to web result we have to perform the following steps:

1) add parameter api=1 to the end of request uri, so it becomes:

PHP
/v_livecalls.php?like=is+like&amp;amp;prefix=9&amp;amp;show=all&amp;amp;api=1


2) add parameter ts=<CURRENT_UNIX_TIMESTAMP> to the end of request uri, so in current example it would be:

PHP
/v_livecalls.php?like=is+like&amp;amp;prefix=9&amp;amp;show=all&amp;amp;api=1&amp;amp;ts=1433535761

3) add seller(buyer) login and login_type, and let us call this uri 'final API uri' 

PHP
/v_livecalls.php?like=is+like&amp;amp;prefix=9&amp;amp;show=all&amp;amp;api=1&amp;amp;ts=1433535761&amp;amp;login=SELLERUSERNAME&amp;amp;login_type=seller


4) In this step we will have to add a security signature, that verifies seller/buyer permission to perform the API call.
For this purpose we concatenate 'final API uri' and seller API signature. The difference between previous steps is that we just add the string, without creating valid HTTP parameter for it, the resulting string we call 'secret string':

PHP
/v_livecalls.php?like=is+like&amp;amp;prefix=9&amp;amp;show=all&amp;amp;api=1&amp;amp;ts=1433535761&amp;amp;login=SELLER_USER&amp;amp;login_type=seller

next we have to calculate SHA256 hash of the 'secret string'. In our example it would be as follows and we would call"signature hash"

PHP
SHA256("/v_livecalls.php?like=is+like&amp;amp;prefix=9&amp;amp;show=all&amp;amp;api=1&amp;amp;ts=1433535761&amp;amp;login=testseller&amp;amp;login_type=sellerzzz
") = "8d7740703b1d00861ae0b664842ae910a88c9ac35c98a61a025172a7e702dba5"


5) The final step is to add 'signature hash' from step 4) using sign parameter to 'final API uri' and add a host part to it:

PHP
http://developers.telecomsxchange.com/v_livecalls.php?$filters=$prefix&amp;show=all&amp;api=1&amp;ts=1433535761&amp;login=$USERNAME&amp;login_type=$TYPE&amp;sign=$token";





# API results:

NOTES:

Successful API results will be provided as 'text/csv' Content-Type. API results and format will be same exactly as if you pressed "download results" when you were logged in through non-API interface.

Failed API calls will result into 'text/html' Content-Type and result will contain explaination.
