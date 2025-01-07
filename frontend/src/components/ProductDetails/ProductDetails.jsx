import React, { useEffect, useState } from 'react'
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Product1 from '../../assets/images/product/product1.png'
import Product2 from '../../assets/images/product/product2.png'
import Product3 from '../../assets/images/product/product3.png'
import Product4 from '../../assets/images/product/product4.png'
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css"; // Import the required styles

const ProductDetails = ( ProductData = [] , message) => {

    const [selectedColor, setSelectedColor] = useState('');
    const [selectedSize, setSelectedSize] = useState('');
    const [quantity, setQuantity] = useState(1);

    const handleColorChange = (event) => {
        setSelectedColor(event.target.value);
      };
    
      const handleSizeChange = (event) => {
        setSelectedSize(event.target.value);
      };
    
      const handleQuantityChange = (event) => {
        setQuantity(event.target.value);
      };

      useEffect(()=> {

      })

    return (
        <Container fluid={true} className="BetweenTwoSection">
          <Row className="p-2">
            <Col className="shadow-sm bg-white pb-3 mt-4" md={12} lg={12} sm={12} xs={12}>
              <Row>
                <Col className="p-3" md={6} lg={6} sm={12} xs={12}>
                  <img className="w-100" src={Product1} alt="Product" />
                  <Container className="my-3">
                    <Row>
                      <Col className="p-0 m-0" md={3} lg={3} sm={3} xs={3}>
                        <img className="w-100" src={Product1} alt="Product1" />
                      </Col>
                      <Col className="p-0 m-0" md={3} lg={3} sm={3} xs={3}>
                        <img className="w-100" src={Product2} alt="Product2" />
                      </Col>
                      <Col className="p-0 m-0" md={3} lg={3} sm={3} xs={3}>
                        <img className="w-100" src={Product3} alt="Product3" />
                      </Col>
                      <Col className="p-0 m-0" md={3} lg={3} sm={3} xs={3}>
                        <img className="w-100" src={Product4} alt="Product4" />
                      </Col>
                    </Row>
                  </Container>
                </Col>
                <Col className="p-3" md={6} lg={6} sm={12} xs={12}>
                  <h5 className="Product-Name">ASUS TUF A15 FA506IU Ryzen 7 4800H GTX</h5>
                  <h6 className="section-sub-title">
                    Some Of Our Exclusive Collection, You May Like Some Of Our Exclusive Collection
                  </h6>
                  <div className="input-group">
                    <div className="Product-price-card d-inline">Regular Price 200</div>
                    <div className="Product-price-card d-inline">50% Discount</div>
                    <div className="Product-price-card d-inline">New Price 100</div>
                  </div>
                  <h6 className="mt-2">Choose Color</h6>
                  <div className="input-group">
                    <div className="form-check mx-1">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="colorOptions"
                        value="Black"
                        onChange={handleColorChange}
                      />
                      <label className="form-check-label">Black</label>
                    </div>
                    <div className="form-check mx-1">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="colorOptions"
                        value="Green"
                        onChange={handleColorChange}
                      />
                      <label className="form-check-label">Green</label>
                    </div>
                    <div className="form-check mx-1">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="colorOptions"
                        value="Red"
                        onChange={handleColorChange}
                      />
                      <label className="form-check-label">Red</label>
                    </div>
                  </div>
    
                  <h6 className="mt-2">Choose Size</h6>
                  <div className="input-group">
                    <div className="form-check mx-1">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="sizeOptions"
                        value="X"
                        onChange={handleSizeChange}
                      />
                      <label className="form-check-label">X</label>
                    </div>
                    <div className="form-check mx-1">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="sizeOptions"
                        value="XX"
                        onChange={handleSizeChange}
                      />
                      <label className="form-check-label">XX</label>
                    </div>
                    <div className="form-check mx-1">
                      <input
                        className="form-check-input"
                        type="radio"
                        name="sizeOptions"
                        value="XXXX"
                        onChange={handleSizeChange}
                      />
                      <label className="form-check-label">XXXX</label>
                    </div>
                  </div>
    
                  <h6 className="mt-2">Quantity</h6>
                  <input
                    className="form-control text-center w-50"
                    type="number"
                    value={quantity}
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
      );
};

export default ProductDetails;