const BaseURL = "http://127.0.0.1:8000/api";

const AppURL = {
  BaseURL: BaseURL,
  PostContact: `${BaseURL}/post-contact`,
  SiteSettings: `${BaseURL}/site-setting`,
  CategoryDetails: `${BaseURL}/categories`,
  Sliders : `${BaseURL}/sliders`,
  Notifications:`${BaseURL}/notifications`,
  UserLogin:`${BaseURL}/login`,
  UserProfile:`${BaseURL}/user`,
  UserRegister:`${BaseURL}/register`,
  ForgetPassword: `${BaseURL}/forget-password`,
  PasswordReset: `${BaseURL}/password-reset`,


  productByRemark(remark) {
    return `${this.BaseURL}/products/remark/${remark}`;
  },

  ProductByCategory(slug) {
    return `${this.BaseURL}/products/category/${slug}`;
  },

  ProductBySubCategory(category_slug, subcategory_slug) {
    return `${this.BaseURL}/product/${category_slug}/${subcategory_slug}`;
  },

  ProductDetails(product_id) {
    return `${this.BaseURL}/product-details/${product_id}`;
  },

  ProductBySearch(query) {
    return `${this.BaseURL}/search/${query}`;
  },


  relatedProduct(product_id) {
    return `${this.BaseURL}/related-product/${product_id}`;
  },


  
};

export default AppURL;
