const BaseURL = "http://127.0.0.1:8000/api";

const AppURL = {
  BaseURL: BaseURL,
  PostContact: `${BaseURL}/post-contact`,
  SiteSettings: `${BaseURL}/site-setting`,
  CategoryDetails: `${BaseURL}/categories`,

  productByRemark(remark) {
    return `${this.BaseURL}/products/remark/${remark}`;
  },

  ProductByCategory(category_id) {
    return `${this.BaseURL}/products/category/${category_id}`;
  },

  ProductBySubCategory(category, subcategory) {
    return `${this.BaseURL}/products/remark/${category}/${subcategory}`;
  },
};

export default AppURL;
