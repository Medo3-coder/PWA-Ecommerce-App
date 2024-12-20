import React, { useEffect, useRef, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import Card from "react-bootstrap/Card";
import "slick-carousel/slick/slick-theme.css";
import axios from "axios";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";

// useRef hook provides a way to persist values across renders without causing the component to re-render when the value changes.

const NewArrival = () => {
  const [productData, setProductData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchNewArrivalProduct = async () => {
      try {
        const response = await axios.get(AppURL.productByRemark("New"));
        setProductData(response.data);
      } catch (error) {
        setError(
          ToastMessages.showError(
            "Failed to load information. Please try again later."
          )
        );
      } finally {
        setLoading(false); // Ensure loading stops in both success and error cases
      }
    };

    fetchNewArrivalProduct();
  }, []);

  const sliderRef = useRef(null);

  const next = () => {
    sliderRef.current.slickNext();
  };

  const previous = () => {
    sliderRef.current.slickPrev();
  };


  if(loading){
    return (
      <Container className="text-center">
         <h4>Loading New Products...</h4>
      </Container>
    );
  }

  if(error){
    return (
      <Container className="text-center">
         <h4>{error}</h4>
      </Container>
    );
  }

  var settings = {
    dots: false,
    infinite: true,
    speed: 500,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 4,
    slidesToScroll: 1,
    initialSlide: 0,
    arrows: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          initialSlide: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  };

  const renderProduct = productData.map((product , index) => {
    return (
      <div>
      <Card className="image-box" key={index}>
        <Card.Img className="center" src={product.image}/>
        <Card.Body>
          <p className="product-name-on-card">{product.title}</p>
          {product.special_price === "na" ? (
            <p className="product-price-on-card">Price: ${product.price}</p>
          ): (
            <p className="product-price-on-card">
              Price: <del className="text-secondary">${product.price}</del>${product.special_price}
            </p>
          )}
        </Card.Body>
      </Card>
    </div>
    );
  })

  return (
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>
          New Arrivals&nbsp;
          <a className="btn btn-sm ml-2 site-btn" href onClick={previous}>
            <i className="fa fa-angle-left"> </i>
          </a>
          &nbsp;
          <a className="btn btn-sm ml-2 site-btn" href onClick={next}>
            <i className="fa fa-angle-right"> </i>
          </a>
        </h2>
      </div>

      <Row>
        <Slider ref={sliderRef} {...settings}>
          {renderProduct}
        </Slider>
      </Row>
    </Container>
  );
};

export default NewArrival;
