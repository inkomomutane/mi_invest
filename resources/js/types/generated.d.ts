declare namespace App.Data {
    export type CityData = {
        id: number | null;
        nome: string;
        province: App.Data.ProvinceData | null;
        neighborhoods?: Array<App.Data.NeighborhoodData> | null;
    };
    
    export type ProvinceData = {
        id: number | null;
        name: string;
        cities?: Array<App.Data.CityData> | null;
    };
    
    export type NeighborhoodData = {
        id: number | null;
        nome: string;
        city: App.Data.CityData | null;
    };
    
    export type MultilevelProvinceData = {
        id: number | null;
        name: string;
        cities: Array<App.Data.CityData> | null;
    };
}

// Types for forms and DTOs
export interface UserDto {
    id?: number;
    name: string;
    email: string;
    phone?: string;
    nip?: string | null;
    sex?: string | null;
    marital_status?: string | null;
    patent_id?: number | null;
    first_name?: string | null;
    second_name?: string | null;
    last_name?: string | null;
    language?: string | null;
    other_languages?: string | null;
    birth_date?: string | null;
    place_of_birth?: string | null;
    nationality?: string | null;
    id_number?: string | null;
    id_emitted_at?: string | null;
    id_expires_at?: string | null;
    passport_number?: string | null;
    passport_emitted_at?: string | null;
    passport_expires_at?: string | null;
    tax_number?: string | null;
    driver_licence?: string | null;
    driver_licence_emitted_at?: string | null;
    driver_licence_expires_at?: string | null;
    dir?: string | null;
    dir_emitted_at?: string | null;
    dir_expires_at?: string | null;
    contacts?: any;
    primary_contact?: string | null;
    emails?: Array<string>;
    primary_email?: string | null;
    addresses?: Array<any>;
    password?: string;
    email_verified_at?: string | null;
    remember_token?: string | null;
    ingress_date?: string | null;
    NIP?: string | null;
}

export interface KeyValueDto {
    key: string;
    value: string;
}

export interface PatentData {
    id: number;
    title: string;
}

export interface ExperienceDto {
    id?: number;
    title: string;
    description?: string;
    start_date?: string;
    end_date?: string;
}

export interface EducationDto {
    id?: number;
    title: string;
    institution?: string;
    start_date?: string;
    end_date?: string;
}

// Flasher types
export interface FlasherResponse {
    envelopes: Array<{
        notification: {
            type: string;
            message: string;
        };
    }>;
}
