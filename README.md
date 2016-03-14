# twitch-stream-hub
A php streamer hub using the twitch API

Installation I simple the things you will need are a working php server mysql and cronjob or a way of running php scripts on a timer

to install you will first need to go into db_connection and edit it so that your database info is in there

then you will want to make a database table with these properties 


| id                  | int(6)              | NO   | PRI    | NULL    | auto_increment |

| stream_display_name | varchar(255)        | NO   |        | NULL    |                |

| embed_code          | varchar(255)        | NO   |        | NULL    |                |

| views               | int(255)            | NO   |        | NULL    |                |

| pos                 | int(255)            | NO   |        | NULL    |                |

| time                | int(255)            | NO   |        | NULL    |                |


Then make a cron job to run live stream_hub_cron.php every minute.
That should have everything up and running now go to stream_hub.html and style it to your liking or use our style.  
