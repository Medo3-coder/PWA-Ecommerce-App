import React, { useState } from "react";
import { Container, Row, Col, Form, Button } from "react-bootstrap";
import { Link, useNavigate } from "react-router-dom";
import Login from "../../assets/images/login.png";
import ToastMessages from "../../toast-messages/toast";
import axios from "axios";
import AppURL from "../../utils/AppURL";

const Register = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");

  const navigate = useNavigate(); // For redirection

  const handleSubmit = async (e) => {
    e.preventDefault();
    let hasErrors = false;

    if (name.trim().length < 3) {
      ToastMessages.showInfo("Name must be at least 3 characters long");
      hasErrors = true;
    }

    // Email validation (simple regex check
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      ToastMessages.showInfo("Enter a valid email address");
      hasErrors = true;
    }

    // Password validation
    //  const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    //  if (!passwordPattern.test(password)) {
    //   ToastMessages.showInfo("Password must be at least 6 characters and include uppercase, lowercase, number, and symbol");
    // hasErrors = true;
    //  }

    // Confirm Password validation
    if (password !== confirmPassword) {
      ToastMessages.showWarning("Passwords do not match");
      hasErrors = true;
    }
    if (hasErrors) return;
    ToastMessages.showSuccess("User registered:", { name, email });

    // Data to send
    const data = {
      name,
      email,
      password,
      password_confirmation: confirmPassword,
    };

    try {
      const response = await axios.post(AppURL.UserRegister, data);
      ToastMessages.showSuccess("Registration successful! Please log in.");
      navigate("/login"); // Redirect to login page after successful registration
    } catch (error) {
      ToastMessages.showError(
        error.response?.data?.message || "Registration failed"
      );
    }
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
                  <h4 className="section-title-login"> REGISTER </h4>
                  <input
                    className="form-control m-2"
                    type="text"
                    name="name"
                    placeholder="Enter Your Name"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    required
                  />
                  <input
                    className="form-control m-2"
                    type="email"
                    name="email"
                    placeholder="Enter Your Email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                  />
                  <input
                    className="form-control m-2"
                    type="password"
                    name="password"
                    placeholder="Enter Your Password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                  />
                  <input
                    className="form-control m-2"
                    type="password"
                    name="confirmPassword"
                    placeholder="Confirm Your Password"
                    value={confirmPassword}
                    onChange={(e) => setConfirmPassword(e.target.value)}
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
