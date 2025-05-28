import axios from "axios";
import AppURL from "../utils/AppURL";
import ToastMessages from "../toast-messages/toast";
import { useQuery } from "react-query";

/**
 * Fetches content from the API
 * @param {string} type - The type of content to fetch
 * @returns {Promise<string>} The content
 */
const fetchContent = async (type) => {
    try {
        console.log('Fetching content for type:', type);
        const response = await axios.get(AppURL.getContent(type));
        console.log('Content response:', response.data);

        if (response.status === 200 && response.data.key === 'success') {
            return response.data.data.content;
        } else {
            throw new Error(response.data.msg || 'Failed to fetch content');
        }
    } catch (error) {
        console.error('Error fetching content:', error);
        throw new Error(error.response?.data?.msg || 'Failed to fetch content');
    }
};

/**
 * Custom hook to fetch site content using React Query
 * @param {string} type - The type of content to fetch
 */
export const useSiteContent = (type) => {
    return useQuery({
        queryKey: ['siteContent', type],
        queryFn: () => fetchContent(type),
        enabled: !!type, // Only fetch if type is truthy

        // Customization options
        staleTime: 1000 * 60 * 5, // 5 minutes
        cacheTime: 1000 * 60 * 10, // 10 minutes
        retry: 2, // Retry twice on failure
        refetchOnWindowFocus: false,
        refetchOnMount: true,
        refetchInterval: false, // Set to a number (e.g., 10000) to enable polling

        onError: (error) => {
            ToastMessages.showError(error.message);
        },

        onSuccess: (data) => {
            ToastMessages.showSuccess("Content loaded successfully");
        },
    });
};
