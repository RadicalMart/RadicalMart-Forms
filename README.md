# RadicalMart Forms

Плагин для добавления и изменения полей в стандартных формах RadicalMart (Joomla 5).

## 🔧 Возможности

- Добавляйте или удаляйте поля в существующих формах RadicalMart.
- Используйте стандартные типы полей Joomla.
- Поддержка как административной панели, так и фронтальной части сайта.

## 📦 Установка и использование

1. **Скачайте плагин**  
   Вы можете загрузить готовый релиз или клонировать репозиторий вручную.

2. **Редактируйте нужную форму**  
   Все формы находятся в папке `forms`. Просто откройте нужный `.xml` файл и добавьте/удалите поля.

3. **Пример добавления поля:**

```xml
<?xml version="1.0" encoding="utf-8"?>
<form addfieldprefix="Joomla\Component\RadicalMart\Administrator\Field">
    <fieldset name="plugins_form" label="PLG_RADICALMART_FORMS_CUSTOM_FIELDSET">
        <fields name="plugins">
            <field name="custom_1" type="text"
                   label="PLG_RADICALMART_FORMS_CUSTOM_FIELD_1"/>
        </fields>
    </fieldset>
</form>
```

### ℹ️ Объяснение параметров

- `addfieldprefix` — путь к пространству имён, откуда загружаются типы полей:
    - Для **админки**:  
      `Joomla\Component\RadicalMart\Administrator\Field`
    - Для **фронта** (сайт):  
      `Joomla\Component\RadicalMart\Site\Field`

- `<fieldset name="...">` — определяет вкладку или секцию, в которой будет отображаться поле.
- `<fields name="plugins">` — определяет, куда сохраняются значения. Обычно используется `plugins`.

### 🧪 Как узнать, какую форму редактировать

Если вы не уверены, в каком XML-файле находится нужная форма — раскомментируйте строку в `Forms.php`, и Joomla выведет это в лог:

```php
// src/Extension/Forms.php
// Строка: 117
```

🔗 [Ссылка на строку в GitHub](https://github.com/RadicalMart/RadicalMart-Forms/blob/master/src/Extension/Forms.php#L117)

## 📄 Справка по типам полей

Joomla поддерживает множество стандартных типов полей, таких как `text`, `select`, `radio`, `media` и другие.

Документация:  
👉 https://docs.joomla.org/Form_field

## 📁 Список доступных форм

| Имя файла                            | Назначение формы       |
|-------------------------------------|------------------------|
| `com_radicalmart.category.xml`      | Категории в админке    |
| `com_radicalmart.checkout.xml`      | Оформления заказа      |
| `com_radicalmart.config.xml`        | Настройки компонента   |
| `com_radicalmart.customer.xml`      | Покупатель в админке   |
| `com_radicalmart.field.xml`         | Поле в админке         |
| `com_radicalmart.fieldset.xml`      | Группа полей в админке |
| `com_radicalmart.meta.xml`          | Мета товар в админке   |
| `com_radicalmart.order.xml`         | Заказ в админке        |
| `com_radicalmart.order_site.xml`    | Заказ на сайте         |
| `com_radicalmart.personal.xml`      | Личные данные на сайте |
| `com_radicalmart.product.prices.xml`| Цены товара в админке  |
| `com_radicalmart.product.xml`       | Товар в админке        |