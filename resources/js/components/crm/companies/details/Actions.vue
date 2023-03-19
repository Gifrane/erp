<template>
    <div class="details-body-actions">
        <div class="body-actions-left">
            <div class="actions-left-previous">
                <router-link to="/crm/companies">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.996 10.8L13.692 4.104L12 2.4L2.4 12L12 21.6L13.692 19.908L6.996 13.2H21.6V10.8H6.996Z" fill="black"/>
                    </svg>

                    <span>{{ $t('pages.crm_companies_details.back_to_companies') }}</span>
                </router-link>
            </div>
        </div>

        <div class="body-actions-right">
            <button class="btn btn-outline-danger">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 7H5V20C5 20.5304 5.21071 21.0391 5.58579 21.4142C5.96086 21.7893 6.46957 22 7 22H17C17.5304 22 18.0391 21.7893 18.4142 21.4142C18.7893 21.0391 19 20.5304 19 20V7H6ZM16.618 4L15 2H9L7.382 4H3V6H21V4H16.618Z" fill="black"/>
                </svg>

                <span>{{ $t('delete') }}</span>
            </button>
        </div>
    </div>
</template>