import React, { Fragment } from 'react';
import { Container, Row, Col } from 'react-bootstrap';

const About = () => {
    return (
        <Fragment>
            <Container>
                <Row className="p-2">
                    <Col className="shadow-sm bg-white mt-2" md={12} lg={12} sm={12} xs={12}>
                        <h4 className="section-title-login">About Us Page</h4>
                        <p className="section-title-contact">
                            Hi! I'm Mohamed Farouk. I am a dedicated software engineer with expertise in React, PHP, Node.js, and full-stack development. 
                            <br /><br />
                            My focus is on creating efficient, scalable, and robust software solutions, seamlessly integrating both frontend and backend frameworks. I have a strong passion for building intuitive user interfaces and optimizing performance to enhance user experiences. With a background in containerization and microservices,
                            <br /><br />
                            I aim to develop modular and resilient applications that can scale effortlessly. I thrive on tackling complex challenges, always striving to stay up-to-date with the latest industry trends and tools.
                            <br /><br />
                            My goal is to deliver high-quality, impactful software that drives innovation and meets business needs. Whether working independently or as part of a collaborative team, I am committed to achieving excellence in every project.
                        </p>
                    </Col>
                </Row>
            </Container>
        </Fragment>
    );
};

export default About;
