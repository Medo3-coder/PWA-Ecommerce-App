import React, { Fragment, useState } from 'react';
import { Container, Row, Col, Form, Button } from 'react-bootstrap';

const Contact = () => {
  const [formData, setFormData] = useState({
    mobileNumber: '',
    email: '',
    message: '',
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission logic here
    console.log('Form data submitted:', formData);
  };

  return (
    <Fragment>
      <Container>
        <Row className="p-2">
          <Col className="shadow-sm bg-white mt-2" md={12} lg={12} sm={12} xs={12}>
            <Row className="text-center">
              <Col className="d-flex justify-content-center" md={6} lg={6} sm={12} xs={12}>
                <Form className="onboardForm" onSubmit={handleSubmit}>
                  <h4 className="section-title-login">CONTACT WITH US</h4>
                  <h6 className="section-sub-title">Please Contact With Us</h6>
                  <input
                    className="form-control m-2"
                    type="text"
                    placeholder="Enter Mobile Number"
                    name="mobileNumber"
                    value={formData.mobileNumber}
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
                  <input
                    className="form-control m-2"
                    type="text"
                    placeholder="Enter Your Message"
                    name="message"
                    value={formData.message}
                    onChange={handleChange}
                  />
                  <Button className="btn btn-block m-2 site-btn-login" type="submit">
                    Send
                  </Button>
                </Form>
              </Col>

              <Col className="p-0 Desktop m-0" md={6} lg={6} sm={6} xs={6}>
                <br /><br />
                <p className="section-title-contact">
                  1635 Franklin Street Montgomery, Near Sherwood Mall. AL 36104
                  <br />
                  Email: Support@Mohamed.com
                </p>

                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d162771.1102477064!2d-74.10054944459704!3d40.70681480276415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1627241390779!5m2!1sen!2sbd"
                  width="600"
                  title='map'
                  height="550"
                  style={{ border: 0 }}
                  allowFullScreen=""
                  loading="lazy"
                ></iframe>



        {/* <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7292345.57542882!2d25.581655534855916!3d26.817182426385546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14368976c35c36e9%3A0x2c45a00925c4c444!2sEgypt!5e0!3m2!1sen!2seg!4v1726736316820!5m2!1sen!2seg"
                  width="600"
                  title="map"
                  height="450"
                  style={{ border: 0 }}
                  allowFullScreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                ></iframe> */}
                
              </Col>
            </Row>
          </Col>
        </Row>
      </Container>
    </Fragment>
  );
};

export default Contact;
