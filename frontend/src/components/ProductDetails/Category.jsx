import { Card, Col, Container, Row } from "react-bootstrap";

const Category = ({ ProductData = [], Slug, message }) => {
  const renderProducts = ProductData.length > 0 ? (
    ProductData.map((product, index) => (
      <Col className="p-0" key={index} xl={3} lg={3} md={3} sm={6} xs={6}>
        <Card className="image-box w-100">
          <Card.Body>
            <Card.Img className="center w-75" src={product.image} alt={product.title} />
            <h5 className="product-name-on-card">{product.title}</h5>
            {product.special_price === "na" ? (
              <p className="product-price-on-card">
                Price : ${product.price}
              </p>
            ) : (
              <p className="product-price-on-card">
                Price : <del className="text-secondary">${product.price}</del> ${product.special_price}
              </p>
            )}
          </Card.Body>
        </Card>
      </Col>
    ))
  ) : (
    <Col>
      <h5>{message || 'No products available in this category.'}</h5>
    </Col>
  );

  return (
    <Container className="text-center" fluid={true}>
      <div className="section-title text-center mb-55">
        <h2>{Slug}</h2>
      </div>
      <Row>{renderProducts}</Row>
    </Container>
  );
};

export default Category;
