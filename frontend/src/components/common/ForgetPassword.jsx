import React, { useState } from "react";
import { Container, Row, Col, Form, Button } from "react-bootstrap";
import Forget from "../../assets/images/forget.jpg";
import ToastMessages from "../../toast-messages/toast";
import axios from "axios";
import AppURL from "../../utils/AppURL";

const ForgetPassword = () => {
  const [email, setEmail] = useState("");

  const handleChange = (e) => {
    setEmail(e.target.value);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post(AppURL.ForgetPassword, {email});
      if (response.status === 200) {
        ToastMessages.showSuccess(response.data.message);
      }
    } catch (e) {
        ToastMessages.showWarning(e.response.data.message);
    }
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
                <h4 className="section-title-login"> FORGET PASSWORD ? </h4>
                <input
                  className="form-control m-2"
                  type="email"
                  placeholder="Enter Your Email"
                  value={email}
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
                alt="Forget Password"
              />
            </Col>
          </Row>
        </Col>
      </Row>
    </Container>
  );
};

export default ForgetPassword;
