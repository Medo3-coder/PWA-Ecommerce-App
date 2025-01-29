import React, { useState } from "react";
import { Container, Row, Col, Form, Button } from "react-bootstrap";
import Forget from "../../assets/images/forget.jpg";
import ToastMessages from "../../toast-messages/toast";

const ResetPassword = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    newPassword: "",
    confirmPassword: "",
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.value]: e.target.value,
    });
  };

  const validateForm = () => {
    if (formData.newPassword !== formData.confirmPassword) {
      ToastMessages.showWarning("Passwords do not match");
      return false;
    }
    return true;
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!validateForm()) {
      return; // Stop submission if validation fails
    }

    console.log("Form Data Submitted:", formData);
    // Show success toast message
    ToastMessages.showInfo(
      "If this email is registered, a reset link will be sent."
    );

    // Reset form after submission
    setFormData({
      name: "",
      email: "",
      newPassword: "",
      confirmPassword: "",
    });
  };

  return (
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
                <h4 className="section-title-login"> RESET PASSWORD </h4>
                <input
                  className="form-control m-2"
                  type="text"
                  name="pin"
                  placeholder="Enter Your Pin Code"
                  value={formData.pin}
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
                  name="newPassword"
                  placeholder="Your New Password"
                  value={formData.newPassword}
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
                  {" "}
                  Reset Password{" "}
                </Button>
              </Form>
            </Col>
            <Col className="p-0 Desktop m-0" md={6} lg={6} sm={6} xs={6}>
              <img
                className="onboardBanner"
                src={Forget}
                alt="Reset Password"
              />
            </Col>
          </Row>
        </Col>
      </Row>
    </Container>
  );
};

export default ResetPassword;
