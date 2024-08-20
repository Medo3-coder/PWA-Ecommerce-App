import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import Card from "react-bootstrap/Card";
import "slick-carousel/slick/slick-theme.css";

export default function NewArrival() {
  var settings = {
    dots: false,
    infinite: false,
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

  return (
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>New Arriva</h2>
      </div>

      <Row>
        <Slider {...settings}>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://rukminim2.flixcart.com/image/612/612/xif0q/bottle/w/e/a/1200-stainless-steel-vacuum-double-insulated-tumbler-with-handle-original-imah3bfqzzwmpkgn.jpeg?q=70"
              />
              <Card.Body>
                <p className="product-name-on-card">
                  HOUSE OF QUIRK Stainless Steel Vacuum Double Insulated
                </p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://rukminim2.flixcart.com/image/612/612/xif0q/pressure-cooker/e/8/y/-original-imagsd28dhfv8dmr.jpeg?q=70"
              />
              <Card.Body>
                <p className="product-name-on-card">
                  Pigeon Special 3 L Inner Lid Pressure Cooker
                </p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://rukminim2.flixcart.com/image/612/612/xif0q/knife-sharpener/9/r/t/0-manual-kitchen-knife-sharpener-2-stage-sharpening-tool-for-original-imahyagdzeqmdknf.jpeg?q=70"
              />
              <Card.Body>
                <p className="product-name-on-card">
                  MGKENTERPRISE Plastic Grocery Container - 1200 ml
                </p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg"
              />
              <Card.Body>
                <p className="product-name-on-card">
                  cello Pack of 18 Opalware Dazzle Lush Fiesta,Pieces
                </p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg"
              />
              <Card.Body>
                <p className="product-name-on-card">Samsung mobile phones</p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://rukminim2.flixcart.com/image/612/612/l1whaq80/bowl/q/l/f/1-1-1-lky-original-imagdd776gbgpybn.jpeg?q=70"
              />
              <Card.Body>
                <p className="product-name-on-card">
                  LIMETRO STEEL Copper Base Handi with Lid{" "}
                </p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://rukminim2.flixcart.com/image/612/612/xif0q/weighing-scale/g/o/7/kitchen-table-top-weight-machine-electronic-digital-1gram-10-kg-original-imahfj6gqzzxmxh6.jpeg?q=70"
              />
              <Card.Body>
                <p className="product-name-on-card">
                  SONALEX Weight Machine 10kg Scale Digital For Shop
                </p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
          <div>
            <Card className="image-box">
              <Card.Img
                className="center"
                src="https://rukminim2.flixcart.com/image/612/612/xif0q/shopsy-chopper/h/u/w/no-axn-combo-of-450-ml-chopper-stainlesssteel-whisk-wooden-original-imagkwc7gj7zqasy.jpeg?q=70"
              />
              <Card.Body>
                <p className="product-name-on-card">
                  DDecora Combo Of 450 ML , Stainless-Steel Whisk
                </p>
                <p className="product-price-on-card">Price : $210</p>
              </Card.Body>
            </Card>
          </div>
        </Slider>
      </Row>
    </Container>
  );
}
