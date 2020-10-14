# Magento 2 Frequently Bought Together GraphQL / PWA

## How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-frequently-bought-together-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## How to use

To start working with GraphQl in Magento, you need the following:
- Use Magento 2.3.x or higher. Returns site to developer mode
- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)
- Mageplaza-supported queries are fully written in the **Description** section of `Query.deliveryTime.DeliveryInfomation`

![](https://i.imgur.com/8OW0Y2G.png)
