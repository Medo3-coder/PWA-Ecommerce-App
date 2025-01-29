import React, { useState } from 'react';
import { Container, Row, Col, Card, ListGroup, Button } from 'react-bootstrap';

const Profile = () => {
    const [user, setUser] = useState({
        name: "John Doe",
        email: "johndoe@example.com",
        phone: "123-456-7890",
        address: "123 Main St, City, Country",
        bio: "Software Developer with a passion for creating amazing applications."
    });

    return (
        <Container className="mt-4">
            <Row className="justify-content-center">
                <Col md={6}>
                    <Card className="shadow-sm">
                        <Card.Body>
                            <Card.Title className="text-center">User Profile</Card.Title>
                            <ListGroup variant="flush">
                                <ListGroup.Item><strong>Name:</strong> {user.name}</ListGroup.Item>
                                <ListGroup.Item><strong>Email:</strong> {user.email}</ListGroup.Item>
                                <ListGroup.Item><strong>Phone:</strong> {user.phone}</ListGroup.Item>
                                <ListGroup.Item><strong>Address:</strong> {user.address}</ListGroup.Item>
                                <ListGroup.Item><strong>Bio:</strong> {user.bio}</ListGroup.Item>
                            </ListGroup>
                            <div className="text-center mt-3">
                                <Button variant="primary" className="m-1">Edit Profile</Button>
                                <Button variant="danger" className="m-1">Logout</Button>
                            </div>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
        </Container>
    );
};

export default Profile;
