import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
// import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";

function Collection() {
  return (
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>Product Collection</h2>
      </div>
      <Row>
        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/312/312/xif0q/computer/u/x/2/a715-76g-gaming-laptop-acer-original-imah3w8hpzgqeqnv.jpeg?q=70"
                  />
                  <h5 className="category-name">Acer Aspire 7 Intel Core i5 12th Gen 12450H - (16 GB/512 GB SSD/) </h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>

        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/312/312/xif0q/computer/v/y/z/-original-imagtucnqsqpbvk6.jpeg?q=70"
                  />
                  <h5 className="category-name">HP Intel Core i5 12th Gen 1235U - (16 GB/512 GB SSD/Windows 11) </h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>


        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/312/312/xif0q/computer/b/k/t/sfg14-71-58ub-thin-and-light-laptop-acer-original-imah3tfbgxjbfqzg.jpeg?q=70"
                  />
                  <h5 className="category-name">Acer Swift Go 14 EVO OLED (2024) Intel Core i5 13th Gen 13500H  </h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>


        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/312/312/xif0q/computer/d/s/c/15s-fq5330tu-thin-and-light-laptop-hp-original-imah3bdpjhc8h2hq.jpeg?q=70"
                  />
                  <h5 className="category-name">ASUS TUF Gaming F15 - AI Powered Gaming Intel Core i5 11th Gen 11 </h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>
        

        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/612/612/xif0q/smartwatch/p/f/d/-original-imagxp8umugr9z35.jpeg?q=70"
                  />
                  <h5 className="category-name">Noise Colorfit Icon 2 1.8 </h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>


        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/612/612/xif0q/smartwatch/0/h/1/39-i8-pink-a1-69-android-ios-gamesir-yes-original-imahfgyvbehkyhv3.jpeg?q=70"
                  />
                  <h5 className="category-name">AGamesir I8 Pink-A1 Full Screen Touch </h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>


        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/612/612/xif0q/smartwatch/z/u/j/46-99-bxio2003-bxsm2003-bxsm2001-android-ios-beatxp-yes-original-imagyhzncy5rn24p.jpeg?q=70"
                  />
                  <h5 className="category-name">beatXP Marv Neo 1.85</h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>


        <Col className="p-0" xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
                <Card.Body>
                  <Card.Img
                    className="center w-75"
                    src="https://rukminim2.flixcart.com/image/612/612/xif0q/smartwatch/8/u/s/-original-imahf5ngfckrg5ug.jpeg?q=70"
                  />
                  <h5 className="category-name">Noise Icon 4 </h5>
                  <p className="product-price-on-card">Price : $210</p>

                </Card.Body>
              </Card>
        </Col>
      </Row>
    </Container>
  );
}

export default Collection;
