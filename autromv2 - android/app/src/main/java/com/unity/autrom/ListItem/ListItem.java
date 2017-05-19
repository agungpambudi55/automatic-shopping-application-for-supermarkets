package com.unity.autrom.ListItem;

public class ListItem {

    public Integer id_product;
    public Integer id_cart;
    public String product_name;
    public String price;
    public String qty;

    public ListItem(Integer id_cart, String product_name, String price, String qty) {
        this.id_cart = id_cart;
        this.product_name = product_name;
        this.price = price;
        this.qty = qty;
    }

    public ListItem(String product_name, String price) {
        this.product_name = product_name;
        this.price = price;
    }

    public ListItem(Integer id_product, Integer id_cart, String product_name, String price) {
        this.id_product = id_product;
        this.id_cart = id_cart;
        this.product_name = product_name;
        this.price = price;
    }

    public String getQty() {
        return qty;
    }

    public void setQty(String qty) {
        this.qty = qty;
    }

    public String getProduct_name() {
        return product_name;
    }

    public Integer getId_product() {
        return id_product;
    }

    public void setId_product(Integer id_product) {
        this.id_product = id_product;
    }

    public Integer getId_cart() {
        return id_cart;
    }

    public void setId_cart(Integer id_cart) {
        this.id_cart = id_cart;
    }

    public void setProduct_name(String product_name) {
        this.product_name = product_name;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }
}
