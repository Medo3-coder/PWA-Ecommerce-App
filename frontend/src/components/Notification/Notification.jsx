import axios from "axios";
import React, { useState, Fragment, useEffect } from "react";
import { Container, Row, Col, Card, Button, Modal } from "react-bootstrap";
import AppURL from "../../utils/AppURL";
import ToastMessages from "../../toast-messages/toast";
import Skeleton from "react-loading-skeleton";
import "react-loading-skeleton/dist/skeleton.css";
import { ResponsiveLayout } from "../../layouts/ResponsiveLayout";

const Notification = () => {
  const [show, setShow] = useState(false);
  const [notification, setNotification] = useState([]);
  const [selectedNotification, setSelectedNotification] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null); // State for errors

  const handleShow = (notification) => {
    setSelectedNotification(notification);
    setShow(true);
  };

  const handleClose = () => {
    setSelectedNotification(null);
    setShow(false);
  };

  useEffect(() => {
    const fetchNotifications = async () => {
      try {
        const response = await axios.get(AppURL.Notifications);
        console.log(response);
        if (response.status === 200) {
          // Ensure the response has a 'notifications' key
          if (
            response.data.notifications &&
            Array.isArray(response.data.notifications)
          ) {
            setNotification(response.data.notifications);
          }
        }
      } catch (e) {
        setError(
          ToastMessages.showError(
            "Failed to load notification Information in page."
          )
        );
      } finally {
        setLoading(false);
      }
    };

    fetchNotifications();
  }, []); // Empty dependency array to run this effect only once on mount

  // Skeleton Loading UI
  const renderSkeletons = Array.from({ length: 6 }).map((_, index) => (
    <Col className="p-1" key={index} md={6} lg={6} sm={12} xs={12}>
      <Card className="notification-card">
        <Card.Body>
          <h6>
            <Skeleton width="60%" />
          </h6>
          <p className="py-1 px-0 text-primary m-0">
            <i className="fa fa-bell"></i>
            <Skeleton width="40%" />
          </p>
          <Skeleton width="100px" height={30} className="mt-2" />
        </Card.Body>
      </Card>
    </Col>
  ));

  if (error) {
    return <div>{error}</div>;
  }

  // Render notifications
  const renderNotifications = notification.map((notifications) => (
    <Col className="p-1" key={notifications.id} md={6} lg={6} sm={12} xs={12}>
      <Card
        onClick={() => handleShow(notifications)}
        className="notification-card"
      >
        <Card.Body>
          <h6>{notifications.title}</h6>
          <p className="py-1 px-0 text-primary m-0">
            <i className="fa fa-bell"></i>
            Date:{new Date(notifications.created_at).toLocaleDateString()}
            Status: {notifications.is_read ? "Read" : "Unread"}
          </p>
          <Button
            variant="danger"
            onClick={() => handleShow(notifications)}
            className="mt-2"
          >
            View Details
          </Button>
        </Card.Body>
      </Card>
    </Col>
  ));

  return (
    <>
      <ResponsiveLayout>
        <Container className="TopSection">
          <Row>{loading ? renderSkeletons : renderNotifications}</Row>
        </Container>
      </ResponsiveLayout>

      <Modal show={show} onHide={handleClose}>
        <Modal.Header closeButton>
          <h6>
            <i className="fa fa-bell"></i> Date:{" "}
            {selectedNotification &&
              new Date(selectedNotification.created_at).toLocaleDateString()}
          </h6>
        </Modal.Header>
        <Modal.Body>
          <h6>{selectedNotification?.title}</h6>
          <p>{selectedNotification?.message}</p>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleClose}>
            Close
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  );
};

export default Notification;
