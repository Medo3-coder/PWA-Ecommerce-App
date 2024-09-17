import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Container from "react-bootstrap/Container";

const FooterDesktop = () => {
       
    return (
    <>
    <div className="footerback m-0 mt-5 pt-3 shadow-sm">
      <Container> 
          <Row className="px-0 my-5">
              <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              <h5 className="footer-menu-title">OFFICE ADDRESS</h5>
               <p>1635 Franklin Street Montgomery, Near Sherwood Mall. AL 36104 <br></br>
               Email: Support@easylearningbd.com
               </p>
               <h5 className="footer-menu-title">SOCIAL LINK</h5>
               <a href="https://www.facebook.com/"><i className="fab m-1 h4 fa-facebook"></i></a>
               <a href="https://www.instagram.com/"><i className="fab m-1 h4 fa-instagram"></i></a>
               <a href="https://www.twitter.com/"><i className="fab m-1 h4 fa-twitter"></i></a>
              </Col>

              <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              <h5 className="footer-menu-title">THE COMPANY</h5>
              </Col>

              <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              <h5 className="footer-menu-title">MORE INFO</h5>
              </Col>


              <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
              <h5 className="footer-menu-title">DOWNLOAD APPS</h5>
              </Col>    
          </Row>

      </Container>
      </div>

    </>
    );
}


export default FooterDesktop ;