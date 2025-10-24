# Magdoni – სრული მინიბლოგი (PHP + MySQL)

სრული, მაგრამ მარტივად გასაგები პროექტი ფრონტენდით და ბექენდით. იდეა: **მინიბლოგი ავტორიზაციით**, სადაც იუზერი დარეგისტრირდება, დაელოგინება და შექმნის/დაარედაქტირებს პოსტებს.

---

## რას ავაწყობთ
- 👤 რეგისტრაცია/ლოგინი/ლოგაუთი
- ✍️ პოსტების CRUD (შექმნა, ნახვა, რედაქტირება, წაშლა)
- 🕵️‍♂️ ავტორის დაფიქსება (ვხედავთ ვინ შექმნა პოსტი)
- 🔐 უსაფრთხოება: password_hash, prepared statements, CSRF token
- 🖼️ მინიმალური, ლამაზი UI (Bootstrap)

**Stack:** PHP 8+, MySQL/MariaDB, HTML5, CSS (Bootstrap 5), Vanilla JS.

---

## ფაილების სტრუქტურა
```
magdoni/
├─ public/
│  ├─ index.php            # მთავარი გვერდი – პოსტების სია
│  ├─ login.php            # ლოგინი
│  ├─ register.php         # რეგისტრაცია
│  ├─ logout.php           # ლოგაუთი
│  ├─ post_create.php      # პოსტის შექმნა
│  ├─ post_edit.php        # პოსტის რედაქტირება
│  ├─ post_delete.php      # პოსტის წაშლა
│  ├─ partials/
│  │  ├─ header.php
│  │  └─ footer.php
│  ├─ assets/
│  │  ├─ styles.css
│  │  └─ app.js
├─ src/
│  ├─ db.php               # DB კავშირი (PDO)
│  ├─ auth.php             # ავტენტიკაცია + CSRF utilities
│  └─ helpers.php          # სასარგებლო ჰელფერები
├─ config.example.php      # კონფიგის შაბლონი
├─ schema.sql              # DB სქემა
└─ README.md               # გაშვების ინსტრუქცია
```

---

## ინსტალაცია

### 1. შექმენი Database
```bash
# შედი MySQL-ში და გაუშვი schema.sql
mysql -u root -p < schema.sql
```

### 2. კონფიგურაცია
```bash
# დააკოპირე config.example.php
cp config.example.php config.php
# შეავსე შენი DB პარამეტრები
```

### 3. გაშვება

**XAMPP-ით (Windows/Mac/Linux):**
```bash
# გადაიტანე პროექტი htdocs საქაღალდეში
# მაგ.: C:/xampp/htdocs/magdoni
# გახსენი ბრაუზერში: http://localhost/magdoni/public
```

**PHP Built-in Server (ნებისმიერი OS):**
```bash
cd public
php -S localhost:8000
# გახსენი ბრაუზერში: http://localhost:8000
```

---

## ფუნქციონალი
- ✅ რეგისტრაცია/შესვლა/გასვლა
- ✅ პოსტების CRUD
- ✅ CSRF დაცვა + password_hash + prepared statements
- ✅ Bootstrap 5 UI

---

## უსაფრთხოება

პროექტში გამოყენებულია თანამედროვე უსაფრთხოების პრაქტიკები:

- **PDO Prepared Statements**: SQL Injection-ის თავიდან აცილება
- **password_hash()**: პაროლების უსაფრთხო შენახვა bcrypt-ით
- **CSRF Tokens**: Cross-Site Request Forgery თავდასხმების პრევენცია
- **XSS Protection**: HTML escape ყველა output-ზე

---

## შემდეგი ნაბიჯები (გართულება)

- სურათების ატვირთვა
- როლები (admin/user)
- pagination + ძიება
- API endpoint-ები (JSON) და პატარა frontend SPA (fetch)
- Webhook მაგალითი

---

## ლიცენზია
MIT
