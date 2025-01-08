import React, { useState } from 'react'
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css"; // Import the required styles

const ProductDetails = ( {productData , message}) => {
  const [previewImg, setPreviewImg] = useState();
  
  if (!productData || !productData.product) {
    return <p>Loading...</p>; // Handle the case where productData is not loaded yet
  }


  const {
    title,
    brand,
    category,
    image,
    quantity,
    price,
    product_code,
    remark,
    special_price,
    star,
  } = productData.product || {};
  
  const {
    image_one,
    image_two,
    image_three,
    image_four,
    color,
    size,
    product_id,
    short_description,
    long_description,
  } = productData.product.product_details || {};

 if(!previewImg){
  setPreviewImg(image);
 }
  
  const handleThumbnailClick = (img)=> {
    setPreviewImg(img);
  }
  
  // Access subcategory
  
  return (
        <Container fluid={true} className="BetweenTwoSection">
          <Row className="p-2">
            <Col className="shadow-sm bg-white pb-3 mt-4" md={12} lg={12} sm={12} xs={12}>
              <Row>
                <Col className="p-3" md={6} lg={6} sm={12} xs={12}>
                  <img className="big-image"  src={previewImg} alt="Product" />
                  <Container className="my-3">
                    <Row>
                      {[image_one, image_two, image_three, image_four].map((img , index)=> 
                         img ? (
                          <Col key={index} className="p-0 m-0" md={3} lg={3} sm={3} xs={3}>
                          <img className="small-image" src={img} alt={`Product ${index + 1}`} onClick={() => handleThumbnailClick(img)} style={{ cursor: "pointer" }} />
                          </Col>
                         ) : null
                      )}
                     
                    </Row>
                  </Container>
                </Col>
                <Col className="p-3" md={6} lg={6} sm={12} xs={12}>
                  <h5 className="Product-Name">{title || "Product Title"}</h5>
                  <h6 className="section-sub-title">
                    {short_description || "Description goes here"}
                  </h6>
                  <div className="input-group">
                    <div className="Product-price-card d-inline">Regular Price: ${price}</div>
                    {special_price && <div className="Product-price-card d-inline">Special Price: ${special_price}</div> }
                    
                    <div className="Product-price-card d-inline">Remark: {remark}</div>
                  </div>
                  <h6 className="mt-2">
                  Category: <b>{category?.category_name || "No Category"}</b>
                 </h6>
                 {/* <h6 className="mt-2">
                  SubCategory: <b>{category?.subcategory?.subcategory_name}</b>
                </h6> */}

                <h6 className="mt-2">
                  Brand: <b>{brand}</b>
                </h6>

                <h6 className="mt-2">
                  Product Code: <b>{product_code}</b>
                </h6>

                <h6 className="mt-2">
                  Quantity: <b>{quantity}</b>
                </h6>
    
    
                  <div className="input-group mt-3">
                    <button className="btn site-btn m-1">
                      <i className="fa fa-shopping-cart"></i> Add To Cart
                    </button>
                    <button className="btn btn-primary m-1">
                      <i className="fa fa-car"></i> Order Now
                    </button>
                    <button className="btn btn-primary m-1">
                      <i className="fa fa-heart"></i> Favourite
                    </button>
                  </div>
                </Col>
              </Row>
    
              <Row>
                <Col md={6} lg={6} sm={12} xs={12}>
                  <h6 className="mt-2">DETAILS</h6>
                  <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat.
                  </p>
                  <p>
                    Ut wisi enim ad minim veniam, quis nostrud exerci tation Lorem ipsum dolor sit amet, consectetuer
                    adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                  </p>
                </Col>
    
                <Col md={6} lg={6} sm={12} xs={12}>
                  <h6 className="mt-2">REVIEWS</h6>
                  <p className="p-0 m-0">
                    <span className="Review-Title">Kazi Ariyan</span>{' '}
                    <span className="text-success">
                      <i className="fa fa-star"></i> <i className="fa fa-star"></i> <i className="fa fa-star"></i>{' '}
                      <i className="fa fa-star"></i>{' '}
                    </span>
                  </p>
                  <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat.
                  </p>
                  {/* Additional reviews go here */}
                </Col>
              </Row>
            </Col>
          </Row>
        </Container>
      );
};

export default ProductDetails;