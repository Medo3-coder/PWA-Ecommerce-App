import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";
import { Form } from "react-bootstrap";
import Login from "../../assets/images/login.png"

const UserLogin = () => {
   return (
    <>
     <Container>
         <Row className="p-2">
             <Col className="shadow-sm bg-white mt-2" md={12} lg={12} sm={12} xs={12}>


             <Row className="text-center">
                <Col className="d-flex justify-content-center" md={6} lg={6} sm={12} xs={12}>
                <Form className="onboardForm">
                    <h4 className="section-title-login">User SignIn</h4>
                    <h6 className="section-sub-title">Please Enter Your Mobile Number</h6>
                    <input className="form-control m-2" type="text" placeholder="Enter Mobile Number" />
                    <Button className="btn btn-block m-2 site-btn-login">Next</Button>

                </Form>
                </Col>
                <Col className="p-0 m-0 Desktop" md={6} lg={6} sm={12} xs={12}>
                   <img className="onboardBanner" src={Login} alt="no_image" />

                </Col>
             </Row>
             
             </Col>
         </Row>
     </Container>
       
    </>
   );
}

export default UserLogin ;

