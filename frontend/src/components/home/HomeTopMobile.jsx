import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import HomeSlider from "./HomeSlider";

const HomeTopMobile = () => {
  return (
    <>
      <Container className="p-0 m-0 overflow-hidden" fluid={true}>
        <Row className="p-0 m-0 overflow-hidden">
          <Col lg={12} md={12} sm={12}>
            {/* <HomeSlider /> */}
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default HomeTopMobile;
