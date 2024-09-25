import React, { useState, Fragment } from 'react';
import { Container, Row, Col, Button, Card } from 'react-bootstrap';
import Product1 from '../../assets/images/product/product1.png';

const Cart = () => {
  // Initial cart state
  const [cartItems, setCartItems] = useState([
    {
      id: 1,
      name: 'ASUS TUF A15 FA506IU Ryzen 7 4800H GTX',
      quantity: 5,
      price: 100,
      image: Product1,
    },
    {
      id: 2,
      name: 'ASUS TUF A15 FA506IU Ryzen 7 4800H GTX',
      quantity: 5,
      price: 100,
      image: Product1,
    },
    {
      id: 3,
      name: 'ASUS TUF A15 FA506IU Ryzen 7 4800H GTX',
      quantity: 5,
      price: 100,
      image: Product1,
    },
    {
      id: 4,
      name: 'ASUS TUF A15 FA506IU Ryzen 7 4800H GTX',
      quantity: 5,
      price: 100,
      image: Product1,
    },
  ]);

  // Handle quantity change
  const updateQuantity = (id, newQuantity) => {
    setCartItems(cartItems.map(item =>
      item.id === id ? { ...item, quantity: newQuantity } : item
    ));
  };

  // Handle item removal
  const removeItem = (id) => {
    setCartItems(cartItems.filter(item => item.id !== id));
  };

  return (
    <Fragment>
      <Container>
        <div className="section-title text-center mb-55">
          <h2>Product Cart List</h2>
        </div>

        <Row>
          {cartItems.map(item => (
            <Col className="p-1" lg={12} md={12} sm={12} xs={12} key={item.id}>
              <Card>
                <Card.Body>
                  <Row>
                    <Col md={3} lg={3} sm={6} xs={6}>
                      <img className="w-100 h-100" src={item.image} alt={item.name} />
                    </Col>

                    <Col md={6} lg={6} sm={6} xs={6}>
                      <h5 className="product-name">{item.name}</h5>
                      <h6> Quantity = {item.quantity} </h6>
                      <h6>Price = {item.quantity} x ${item.price} = ${item.quantity * item.price}</h6>
                    </Col>

                    <Col md={3} lg={3} sm={12} xs={12}>
                      <input
                        value={item.quantity}
                        onChange={(e) => updateQuantity(item.id, parseInt(e.target.value) || 1)}
                        className="form-control text-center"
                        type="number"
                      />
                      <Button
                        onClick={() => removeItem(item.id)}
                        className="btn btn-block w-100 mt-3 site-btn"
                      >
                        <i className="fa fa-trash-alt"></i> Remove
                      </Button>
                    </Col>
                  </Row>
                </Card.Body>
              </Card>
            </Col>
          ))}
        </Row>
      </Container>
    </Fragment>
  );
};

export default Cart;
