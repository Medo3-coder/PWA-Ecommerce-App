import Container from "react-bootstrap/Container";
import { Link } from "react-router-dom";
import Navbar from "react-bootstrap/Navbar";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Logo from "../../assets/images/logo.jpg";

const NavMenuDesktop = () => {
  return (
    <>
      <div className="TopSectionDown">
        <Navbar className="navbar" fixed={"top"}>
          <Container fluid={true}>
            <Row>
              <Col lg={4} md={4} sm={12} xs={12}>
                <Link to="/">
                  <img className="nav-logo" src={Logo} alt="logo"/>
                </Link>
              </Col>

              <Col lg={4} md={4} sm={12} xs={12}></Col>

              <Col lg={4} md={4} sm={12} xs={12}></Col>
            </Row>
          </Container>
        </Navbar>
      </div>
    </>
  );
};

export default NavMenuDesktop;
