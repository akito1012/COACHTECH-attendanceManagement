#COACHTECH勤怠管理アプリ

coachtechスクールカリキュラム、模擬案件で実践に近い開発プログラムの案件の経験を積むテスト形式の練習

##概要

-勤怠管理システム

-勤怠と管理

##環境構築

###Dockerビルド

１．
`git@github.com:akito1012/COACHTECH-attendanceManagement.git`

２．DockerDesktopアプリを立ち上げる

３．
`docker-compose up -d --build`

ARM64の場合以下の文をmysqlとphpmyadminのimageの下に張り付ける

`platform:"linux/x86_64"`

###Laravel環境構築

１．
`docker-compose exec php bash`

２．
`composer install`

３．「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成

４．.envに以下の環境変数を追加
```
`DB_CONNECTION=mysql`
`DB_HOST=mysql`
`DB_PORT=3306`
`DB_DATABASE=laravel_db`
`DB_USERNAME=laravel_user`
`DB_PASSWORD=laravel_pass`
```

５.　php artisan key:generate

６　.php artisan migrate

７.　php artisan db:seed

## user用のログイン初期データ

- メールアドレス: User@mailaddress.com
- パスワード: password
- 

###使用技術（実行環境）

・php8.1.2

・laravel8.83.8

・mysql8.0.26

###ER図



###URL

・開発環境：http://localhost/

・phpMyAdmin:：http://localhost:8080/
  

