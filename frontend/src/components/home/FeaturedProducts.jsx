import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
// import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";

function FeaturedProducts() {
  return (
    // <></>
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>Featured Product</h2>
        <p>Some Of Our Exclusive Collection , You May Like</p>
      </div>
      <Row>
        <Col className="p-1" key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
          <Card className="image-box" style={{ width: "18rem" }}>
            <Card.Img className="center" src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg" />
            <Card.Body>
              <p className="product-name-on-card">Samsung mobile phones</p>
              <p className="product-price-on-card">Price : $210</p>
            </Card.Body>
          </Card>
        </Col>
        <Col className="p-1" key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
          <Card className="image-box" style={{ width: "18rem" }}>
            <Card.Img className="center" src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg" />
            <Card.Body>
              <p className="product-name-on-card">Samsung mobile phones</p>
              <p className="product-price-on-card">Price : $210</p>
            </Card.Body>
          </Card>
        </Col>
        <Col className="p-1" key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
          <Card className="image-box" style={{ width: "18rem" }}>
            <Card.Img className="center" src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg" />
            <Card.Body>
              <p className="product-name-on-card">Samsung mobile phones</p>
              <p className="product-price-on-card">Price : $210</p>
            </Card.Body>
          </Card>
        </Col>
        <Col className="p-1" key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
          <Card className="image-box" style={{ width: "18rem" }}>
            <Card.Img className="center" src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg" />
            <Card.Body>
              <p className="product-name-on-card">Samsung mobile phones</p>
              <p className="product-price-on-card">Price : $210</p>
            </Card.Body>
          </Card>
        </Col>
        <Col className="p-1" key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
          <Card className="image-box" style={{ width: "18rem" }}>
            <Card.Img className="center" src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg" />
            <Card.Body>
              <p className="product-name-on-card">Samsung mobile phones</p>
              <p className="product-price-on-card">Price : $210</p>
            </Card.Body>
          </Card>
        </Col>
        <Col className="p-1" key={1} xl={2} lg={2} md={2} sm={4} xs={6}>
          <Card className="image-box" style={{ width: "18rem" }}>
            <Card.Img className="center" src="https://img.etimg.com/photo/msid-98945112,imgsize-13860/SamsungGalaxyS23Ultra.jpg" />
            <Card.Body>
              <p className="product-name-on-card">Samsung mobile phones</p>
              <p className="product-price-on-card">Price : $210</p>
            </Card.Body>
          </Card>
        </Col>
      </Row>
    </Container>
  );
}

export default FeaturedProducts;
