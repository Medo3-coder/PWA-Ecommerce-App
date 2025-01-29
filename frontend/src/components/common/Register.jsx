import React, { useState } from "react";
import { Container, Row, Col, Form, Button } from "react-bootstrap";
import { Link } from "react-router-dom";
import Login from "../../assets/images/login.png";
import ToastMessages from "../../toast-messages/toast";

const Register = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    confirmPassword: "",
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (formData.password !== formData.confirmPassword) {
      ToastMessages.showWarning("Passwords do not match");
      return;
    }
    ToastMessages.showSuccess("User registered:", formData);
  };

  return (
    <>
      <Container>
        <Row className="p-2">
          <Col
            className="shadow-sm bg-white mt-2"
            md={12}
            lg={12}
            sm={12}
            xs={12}
          >
            <Row className="text-center">
              <Col
                className="d-flex justify-content-center"
                md={6}
                lg={6}
                sm={12}
                xs={12}
              >
                <Form className="onboardForm" onSubmit={handleSubmit}>
                  <h4 className="section-title-login">  REGISTER </h4>
                  <input
                    className="form-control m-2"
                    type="text"
                    name="name"
                    placeholder="Enter Your Name"
                    value={formData.name}
                    onChange={handleChange}
                    required
                  />
                  <input
                    className="form-control m-2"
                    type="email"
                    name="email"
                    placeholder="Enter Your Email"
                    value={formData.email}
                    onChange={handleChange}
                    required
                  />
                  <input
                    className="form-control m-2"
                    type="password"
                    name="password"
                    placeholder="Enter Your Password"
                    value={formData.password}
                    onChange={handleChange}
                    required
                  />
                  <input
                    className="form-control m-2"
                    type="password"
                    name="confirmPassword"
                    placeholder="Confirm Your Password"
                    value={formData.confirmPassword}
                    onChange={handleChange}
                    required
                  />
                  <Button
                    className="btn btn-block m-2 site-btn-login"
                    type="submit"
                  >
                    Sign Up
                  </Button>
                  <br />
                  <br />
                  <hr />
                  <p>
                    <b>Forget My Password? </b>
                    <Link to="/forgot-password">
                      <b>Forget Password</b>
                    </Link>
                  </p>
                  <p>
                    <b>Already Have An Account? </b>
                    <Link to="/login">
                      <b>Login</b>
                    </Link>
                  </p>
                </Form>
              </Col>
              <Col className="p-0 Desktop m-0" md={6} lg={6} sm={6} xs={6}>
                <img className="onboardBanner" src={Login} alt="Login Banner" />
              </Col>
            </Row>
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default Register;
