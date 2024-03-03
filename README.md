
#server
#{
    #listen 80;
		#listen 443 ssl http2;
    #server_name healthandtourismturkey.com;
    #index index.php index.html index.htm default.php default.htm default.html;
    #root /www/wwwroot/healthandtourismturkey.com/public;

    if ($server_port !~ 443){
        rewrite ^(/.*)$ https://$host$1 permanent;
    }
   
    ssl_certificate    /www/server/panel/vhost/cert/healthandtourismturkey.com/fullchain.pem;
    ssl_certificate_key    /www/server/panel/vhost/cert/healthandtourismturkey.com/privkey.pem;
    ssl_protocols TLSv1.1 TLSv1.2 TLSv1.3;
    ssl_ciphers EECDH+CHACHA20:EECDH+CHACHA20-draft:EECDH+AES128:RSA+AES128:EECDH+AES256:RSA+AES256:EECDH+3DES:RSA+3DES:!MD5;
    ssl_prefer_server_ciphers on;
    ssl_session_cache shared:SSL:10m;
    ssl_session_timeout 10m;
    add_header Strict-Transport-Security "max-age=31536000";
    error_page 497  https://$host$request_uri;
		
    location /ws {
        proxy_pass http://127.0.0.1:3000; # Adjust the port to your WebSocket server's port
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
    }


    
    include enable-php-82.conf;
  


    include /www/server/panel/vhost/rewrite/healthandtourismturkey.com.conf;


    
    location ~ ^/(\.user.ini|\.htaccess|\.git|\.env|\.svn|\.project|LICENSE|README.md)
    {
        return 404;
    }

    
    location ~ \.well-known{
        allow all;
    }

    
    if ( $uri ~ "^/\.well-known/.*\.(php|jsp|py|js|css|lua|ts|go|zip|tar\.gz|rar|7z|sql|bak)$" ) {
        return 403;
    }

    location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
    {
        expires      30d;
        error_log /dev/null;
        access_log /dev/null;
    }

    location ~ .*\.(js|css)?$
    {
        expires      12h;
        error_log /dev/null;
        access_log /dev/null; 
    }
    access_log  /www/wwwlogs/healthandtourismturkey.com.log;
    error_log  /www/wwwlogs/healthandtourismturkey.com.error.log;
}