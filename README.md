# Magento 2 Frequently Bought Together GraphQL / PWA

**Magento Frequently Bought Together GraphQL is a part of Mageplaza Frequently Bought Together extension that adds GraphQL features; this supports PWA Studio.**

[Mageplaza Frequently Bought Together for Magento 2](https://www.mageplaza.com/magento-2-frequently-bought-together/) assists store owners in showing related products to suggest customers with the most relevant bought-together products. 

The store admin can easily generate the suggested product list on the backend and configure it to display one or multiple products related to the ones customers are currently checking out. The purpose of this method is to introduce to customers products that can be added to the cart with their wanted ones. Therefore, all the important information, such as product name, price, and more, are included to help customers understand the suggested products and decide to buy or not more wisely. 

Customers can add as many as items in the frequently bought together to their cart. If they want to remove an item and reselect a new one, it can be done easily with a single click. The extension also supports the “Add all to cart” button so that customers can add all the products they want to buy with the initial ones quickly. 

Another outstanding feature of Magento Frequently Bought Together extension is that it provides product attributes right on the suggested block. This enables customers to filter out the favorite options on the list by choosing the attributes instead of accessing every single product page to be able to select product attributes. 

The price of every single product in the list and the total price of all are displayed clearly on the Frequently Bought Together block. Customers can see the price and immediately know if the products are affordable. If there is any change in customers’ selection, the price will be automatically updated thanks to the Ajax loading technique. 


## 1. How to install

Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-frequently-bought-together-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

**Note:** Magento 2 Frequently Bought Together GraphQL requires installing [Mageplaza Frequently Bought Together](https://www.mageplaza.com/magento-2-frequently-bought-together/) in your Magento installation.   

## 2. How to use

To start working with GraphQl in Magento, you need the following:
- Use Magento 2.3.x or higher. Returns site to developer mode
- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)
- Mageplaza-supported queries are fully written in the **Description** section of `Query.deliveryTime.DeliveryInfomation`

![](https://i.imgur.com/8OW0Y2G.png)

## 3. Devdocs

- [Magento 2 Frequently Bought Together API & examples](https://documenter.getpostman.com/view/10589000/SzYXWeGM?version=latest)
- [Magento 2 Frequently Bought Together GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzYXVyE3?version=latest)

Click on Run in Postman to add these collections to your workspace quickly. 

![Magento 2 Auto Related Products graphql pwa](https://i.imgur.com/lhsXlUR.gif)

## 4. Contribute to this module
Feel free to **Fork** and contribute to this module. You can also create a pull request, so we will merge your changes in main branch.

## 5. Get Support 
- Feel free to [contact us](https://www.mageplaza.com/contact.html) if you have any questions. 
- If you find this project helpful. please give us a **Star** ![star](https://i.imgur.com/S8e0ctO.png)


