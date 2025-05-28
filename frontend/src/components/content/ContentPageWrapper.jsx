import React from 'react';
import { useParams } from 'react-router-dom';
import ContentPage from './ContentPage';
import { Container } from 'react-bootstrap';
import { ResponsiveLayout } from '../../layouts/ResponsiveLayout';

const ContentPageWrapper = () => {
    const { type } = useParams();
    
    // Map content types to their titles
    const titles = {
        about: 'About Us',
        privacy: 'Privacy Policy',
        refund: 'Refund Policy',
        purchase_guide: 'Purchase Guide'
    };

    return (
        <ResponsiveLayout>
            <Container fluid className="content-page-wrapper">
                <ContentPage 
                    type={type}
                    title={titles[type] || 'Content'}
                />
            </Container>
        </ResponsiveLayout>
    );
};

export default ContentPageWrapper; 