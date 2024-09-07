import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import MegaMenu from "./MegaMenu";
import HomeSlider from "./HomeSlider";

function HomeTop() {
  return (
    <Container className="p-0 m-0 overflow-hidden" fluid={true}>
      <Row>
        {/* mega menu */}
        <Col lg={3} md={3} sm={12}>
          <MegaMenu />
           
        </Col>

        {/* slider menu */}
        <Col lg={9} md={9} sm={12}>
          <HomeSlider />
        
        </Col>
      </Row>
    </Container>
  );
}

export default HomeTop;
