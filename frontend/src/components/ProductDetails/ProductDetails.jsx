import React, { useState } from 'react'
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css"; // Import the required styles
import ToastMessages from '../../toast-messages/toast';
import Breadcrumb from "react-bootstrap/Breadcrumb";
import { Link } from 'react-router-dom';
import SuggestedProduct from './SuggestedProduct';


const ProductDetails = ( {productData , message}) => {
  const [previewImg, setPreviewImg] = useState();
  const [qty, setQuantity] = useState(1);
  const [errorMessage, setErrorMessage] = useState(""); // State for error message

  
  if (!productData || !productData.product) {
    return <p>Loading...</p>; // Handle the case where productData is not loaded yet
  }


  const {
    title,
    brand,
    category,
    image,
    quantity: stockQuantity, // Available stock in the database
    price,
    product_code,
    remark,
    special_price,
    star,
  } = productData.product || {};
  // alert(category?.subcategories?.name);
  
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

   
 const handleQuantityChange = (e) => {
  const value = e.target.value ;

  if(value > stockQuantity){
    setErrorMessage(ToastMessages.showWarning(`Sorry , we only have ${stockQuantity} units in stock.`));
  }else {
    setErrorMessage("");
  }
  setQuantity(value >= 1 ? value : 1); // Ensure quantity doesn't go below 1
};
  
  const handleThumbnailClick = (img)=> {
    setPreviewImg(img);
  }

  // Access subcategory
  
  return (
    <>
    <Container fluid={true} className="BetweenTwoSection">
             <div className="breadbody">
            
          <Breadcrumb>
            <Breadcrumb.Item ><Link className="text-link" to={`/`}>Home</Link></Breadcrumb.Item>
            <Breadcrumb.Item ><Link className="text-link" to={`/${category?.slug}`}>{category?.slug}</Link></Breadcrumb.Item>
            <Breadcrumb.Item ><Link className="text-link" to={`/product-details/${product_id}`}>{title}</Link></Breadcrumb.Item>
            {/* <Breadcrumb.Item ><Link className="text-link" to={`/${category?.subcategories.slug}`}>{category?.subcategories.slug}</Link></Breadcrumb.Item> */}


          </Breadcrumb>
        </div>
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
                    <div className="Product-price-card d-inline">Was: ${special_price ? (<del>{price}</del>) : price }</div>
                    {special_price && <div className="Product-price-card d-inline">Now: ${special_price}</div> }
                    
                    <div className="Product-price-card d-inline">Remark: {remark}</div>
                  </div>
                  <h6 className="text-success mt-2"> <b>Saving: ${price - special_price}</b></h6>

                  <h6 className="mt-2">
                  Category: <b>{category?.category_name || "No Category"}</b>
                 </h6>
                 {/* <h6 className="mt-2">
                  SubCategory: <b>{category?.subcategories?.subcategory_name}</b>
                  </h6> */}

                <h6 className="mt-2">
                  Brand: <b>{brand}</b>
                </h6>

                <h6 className="mt-2">
                  Product Code: <b>{product_code}</b>
                </h6>

                {color && color.length > 0 && (
                  <>
                <h6 className="mt-2">Choose Color</h6>
                  <div className="input-group">
                    {color.map((colorOption , index)=> (
                      <div key={index}  className="form-check mx-1">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="colorOptions"
                        value={colorOption}
                        id={`color-${index}`}
                        />
                      <label className="form-check-label" htmlFor={`color-${index}`}>
                        {colorOption}
                      </label>
                      </div>
                    ))}
                  </div>
                  </>
               )}
                    
    
                  {size && size.length > 0 && (
                    <>
                  <h6 className="mt-2">Choose Size</h6>
                    <div className="input-group">
                      {size.map((sizeOption , index) => (
                        <div className="form-check mx-1">
                        <input
                          className="form-check-input"
                          type="radio"
                          name="sizeOptions"
                          value={sizeOption}
                          id={`color-${index}`}
                          />
                        <label className="form-check-label" htmlFor={`color-${index}`}>
                           {sizeOption}
                        </label>
                      </div>
                      ))}
                
                    </div>
                 </>
                  )}
                 

                  <h6 className="mt-2">Quantity</h6>
                  <input
                    className="form-control text-center w-50"
                    type="number"
                    value={qty}
                    onChange={handleQuantityChange}
                    />
    
    
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

        <SuggestedProduct product_id = {product_id} />

       </>
      );
    };
    
    export default ProductDetails;