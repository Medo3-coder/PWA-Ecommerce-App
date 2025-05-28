import React from 'react';
import { Container, Row, Col, Card } from 'react-bootstrap';

const ContentSkeleton = () => {
    return (
        <Container className="py-5">
            <Row className="justify-content-center">
                <Col md={10}>
                    <Card className="border-0 shadow-sm">
                        <Card.Header className="bg-white">
                            <div className="skeleton-title"></div>
                        </Card.Header>
                        <Card.Body>
                            <div className="skeleton-content">
                                <div className="skeleton-line"></div>
                                <div className="skeleton-line"></div>
                                <div className="skeleton-line"></div>
                                <div className="skeleton-line"></div>
                                <div className="skeleton-line"></div>
                                <div className="skeleton-line"></div>
                                <div className="skeleton-line"></div>
                                <div className="skeleton-line"></div>
                            </div>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
        </Container>
    );
};

export default ContentSkeleton; 