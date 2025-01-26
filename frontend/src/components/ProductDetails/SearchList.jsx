import { Card, Col, Container, Row } from "react-bootstrap";
import { Link } from "react-router-dom";
import Breadcrumb from "react-bootstrap/Breadcrumb";

const SearchList = ({ ProductData = [], SearchKey }) => {
  const renderProducts =
    ProductData.length > 0 ? (
      ProductData.map((product, index) => (
        <Col className="p-0" key={index} xl={3} lg={3} md={3} sm={6} xs={6}>
          <Link className="text-link" to={`/product-details/${product.id}`}>
            <Card className="image-box w-100">
              <Card.Body>
                <Card.Img
                  className="center w-75"
                  src={product.image}
                  alt={product.title}
                />
                <h5 className="product-name-on-card">{product.title}</h5>
                {product.special_price === "na" ? (
                  <p className="product-price-on-card">
                    Price : ${product.price}
                  </p>
                ) : (
                  <p className="product-price-on-card">
                    Price :{" "}
                    <del className="text-secondary">${product.price}</del> $
                    {product.special_price}
                  </p>
                )}
              </Card.Body>
            </Card>
          </Link>
        </Col>
      ))
    ) : (
      <Col>
        <h5>No products found for "{SearchKey}"</h5>
      </Col>
    );

  return (
    <Container className="text-center" fluid={true}>
      <div className="breadbody">
        <Breadcrumb>
          <Breadcrumb.Item>
            <Link className="text-link" to="/">
              Home
            </Link>
          </Breadcrumb.Item>
          <Breadcrumb.Item>Search Results for: {SearchKey}</Breadcrumb.Item>
        </Breadcrumb>
      </div>
      <div className="section-title text-center mb-40 mt-2">
        <h2>Results for "{SearchKey}"</h2>
      </div>
      <Row>{renderProducts}</Row>
    </Container>
  );
};

export default SearchList;
