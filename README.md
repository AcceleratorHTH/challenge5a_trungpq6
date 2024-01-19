# Deploy Step-by-step
## OS used: Ubuntu 22.04 LTS 
### Chạy update
```
sudo apt-get update
```
### Cài Webserver
```
sudo apt-get install apache2
```
### Cài đặt mysql
```
sudo apt-get install mysql-server
mysql_secure_installation
```
### Cài đặt php
```
sudo apt-get install php php-mysql
```
### Cài đặt phpmyadmin
```
sudo apt-get install phpmyadmin php-mbstring php-zip php-gd php-json php-curl
```
Nếu xảy ra lỗi  
![image](https://github.com/AcceleratorHTH/challenge5a_trungpq6/assets/86862725/ce40954d-06d3-40a8-8f96-3e2c36b9a2a6)

Chọn abort để dừng quá trình cài đặt  
![image](https://github.com/AcceleratorHTH/challenge5a_trungpq6/assets/86862725/a1905ab5-701a-4484-b591-5965fe5898d2)


Tắt xác thực:
```
mysql -u root -p
UNINSTALL COMPONENT "file://component_validate_password";
exit
```
Tiến hành cài đặt tiếp phpmyadmin
```
sudo apt-get install phpmyadmin
```
Bật lại xác thực:
```
mysql -u root -p
INSTALL COMPONENT "file://component_validate_password";
SELECT user,authentication_string,plugin,host FROM mysql.user;
```
Nếu tạo user mới:
```
CREATE USER 'phpmyadmin'@'localhost' IDENTIFIED WITH mysql_native_password BY '<Mật khẩu>';
```
Hoặc sửa lại phương thức mật khẩu cho user phpmyadmin nếu đã tồn tại do `caching_sha2_password` hay xảy ra lỗi.
```
ALTER USER 'phpmyadmin'@'localhost' IDENTIFIED WITH mysql_native_password BY '<Mật khẩu>';
```
Phân quyền
```
GRANT ALL PRIVILEGES ON *.* TO 'phpmyadmin'@'localhost' WITH GRANT OPTION;
exit
```
Kích hoạt phpmyadmin
```
sudo vi /etc/apache2/apache2.conf
Thêm dòng này vào cuối: Include /etc/phpmyadmin/apache.conf
sudo systemctl restart apache2
```
Vào `localhost/phpmyadmin`, đăng nhập, tạo một CSDL mới và import file database vào.

### Dựng trang web
Tiến đến thư mục chứa web
```
cd /var/www/html && rm -rf *
```

Tải source web về
```
git clone https://github.com/AcceleratorHTH/challenge5a_trungpq6.git && mv challenge5a_trungpq6/* . && rm -rf challenge5a_trungpq6/ && chown -R www-data:www-data views/uploads
```

#### Kích hoạt environment từ composer:
```
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
rm -rf composer-setup.php
composer require vlucas/phpdotenv
```
Tạo file .env sử dụng lênh `vi .env` và thêm nội dung như sau:
```
DB_HOST='localhost'
DB_NAME='<Tên CSDL>'
DB_USER='phpmyadmin'
DB_PASS='<Mật khẩu>'

PEPPER='<Tùy ý>'
```
#### Kích hoạt .htaccess: 
`sudo vi /etc/apache2/sites-available/000-default.conf`
Thêm dòng sau vào cuối hoặc nếu đã có sẵn thì chỉ cần thêm dòng `AllowOverride All`
```
<Directory /var/www/>
    AllowOverride All
</Directory>
```
Bật rewrite và khởi động lại apache2
```
sudo a2enmod rewrite
sudo  systemctl restart apache2
```
Ghi nội dung file .htaccess: `vi ./htaccess`
```
<Files .env>
    Order allow,deny
    Deny from all
</Files>
Options -Indexes
```

### Lưu lại và trang web sẽ chạy.
