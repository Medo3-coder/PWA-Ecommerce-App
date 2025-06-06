import React, { Fragment, useEffect, useState } from "react";
import { NameRegx } from "../../validation/Validation";
import axios from "axios";
import ToastMessage from "../../toast-messages/toast";
import { Container, Row, Col, Form, Button } from "react-bootstrap";

import AppURL from "../../utils/AppURL";
import { ResponsiveLayout } from "../../layouts/ResponsiveLayout";

const Contact = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });

  useEffect(() => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  }, []);

  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  //   const handleMessageChange = (event) => {
  //     setMessage(event.target.value);
  // };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const { name, email, message } = formData;

    // Validate form fields
    if (message.trim().length === 0) {
      ToastMessage.showError("Please write your message");
    } else if (name.trim().length === 0) {
      ToastMessage.showError("Please write your name");
    } else if (email.trim().length === 0) {
      ToastMessage.showError("Please enter your email");
    } else if (!NameRegx.test(name)) {
      ToastMessage.showError("Invalid name. Please enter a valid name.");
    } else {
      setIsSubmitting(true);

      try {
        const requestData = new FormData();
        requestData.append("name", name);
        requestData.append("email", email);
        requestData.append("message", message);
        const response = await axios.post(AppURL.PostContact, requestData);

        if (response.status === 201) {
          ToastMessage.showSuccess("the Message was successfully sent");

          setFormData({ name: "", email: "", message: "" });
        } else {
          ToastMessage.showError("Error occurred while sending the message");
        }
      } catch (error) {
        ToastMessage.showError(
          "Error: " + error.response?.data.message || error.message
        );
      } finally {
        setIsSubmitting(false);
      }
    }
  };

  return (
    <>
      <ResponsiveLayout>
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
                    <h4 className="section-title-login">CONTACT WITH US</h4>
                    <h6 className="section-sub-title">
                      Please Contact With Us
                    </h6>
                    <input
                      className="form-control m-2"
                      type="text"
                      placeholder="Name"
                      name="name"
                      value={formData.name}
                      onChange={handleChange}
                    />
                    <input
                      className="form-control m-2"
                      type="email"
                      placeholder="Enter Email"
                      name="email"
                      value={formData.email}
                      onChange={handleChange}
                    />
                    <Form.Control
                      className="form-control m-2"
                      as="textarea"
                      name="message"
                      value={formData.message}
                      placeholder="Message"
                      rows={3}
                      onChange={handleChange}
                    />

                    <Button
                      className="btn btn-block m-2 site-btn-login"
                      id="sendBtn"
                      disabled={isSubmitting}
                      type="submit"
                    >
                      {isSubmitting ? "Sending..." : "send"}
                    </Button>
                  </Form>
                </Col>

                <Col className="p-0 Desktop m-0" md={6} lg={6} sm={6} xs={6}>
                  <br />
                  <br />
                  <p className="section-title-contact">
                    1635 Franklin Street Montgomery, Near Sherwood Mall. AL
                    36104
                    <br />
                    Email: Support@Mohamed.com
                  </p>

                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d162771.1102477064!2d-74.10054944459704!3d40.70681480276415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1627241390779!5m2!1sen!2sbd"
                    width="600"
                    title="map"
                    height="550"
                    style={{ border: 0 }}
                    allowFullScreen=""
                    loading="lazy"
                  ></iframe>
                </Col>
              </Row>
            </Col>
          </Row>
        </Container>
      </ResponsiveLayout>
    </>
  );
};

export default Contact;
