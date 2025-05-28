import { useState, useEffect } from 'react';
import axios from 'axios';
import AppURL from '../utils/AppURL';
import ToastMessages from '../toast-messages/toast';

export const useSiteSettings = () => {
    const [settings, setSettings] = useState({
        address: '',
        androidAppLink: '',
        iosAppLink: '',
        facebookLink: '',
        twitterLink: '',
        instagramLink: '',
        copyrightText: '',
        defaultImage: ''
    });
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        const fetchSettings = async () => {
            try {
                const response = await axios.get(AppURL.getSettings);
                if (response.status === 200 && response.data.key === 'success') {
                    const siteData = response.data.data;
                    console.log(siteData);
                    setSettings({
                        address: siteData.address,
                        androidAppLink: siteData.android_app_link,
                        iosAppLink: siteData.ios_app_link,
                        facebookLink: siteData.facebook_link,
                        twitterLink: siteData.twitter_link,
                        instagramLink: siteData.instagram_link,
                        copyrightText: siteData.copyright_text,
                        defaultImage: siteData.default_image
                    });
                } else {
                    ToastMessages.showError(response.data.msg || "Failed to fetch site info");
                }
            } catch (error) {
                ToastMessages.showError("Failed to fetch site info");
            } finally {
                setIsLoading(false);
            }
        };

        fetchSettings();
    }, []);

    return { settings, isLoading };
}