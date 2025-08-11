<script setup lang="ts">
import ProfileLink from "./Links/ProfileLink.vue";
import PropertysLink from "./Links/PropertysLink.vue";
import NotAprrovedPropertysLink from "./Links/NotAprrovedPropertysLink.vue";
import PropertysTrashLink from "./Links/PropertysTrashLink.vue";
import PaginasLink from "./Links/PaginasLink.vue";
import BannersLink from "./Links/BannersLink.vue";
import UsersLink from "./Links/UsersLink.vue";
import TransationTypesLink from "./Links/TransationTypesLink.vue";
import IntermediationRulesLink from "./Links/IntermediationRulesLink.vue";
import NegociationRulesLink from "./Links/NegociationRulesLink.vue";
import PropertyConditionsLink from "./Links/PropertyConditionsLink.vue";
import PropertyTypesLink from "./Links/PropertyTypesLink.vue";
import PropertyStatusLink from "./Links/PropertyStatusLink.vue";
import ProvincesLink from "./Links/PovincesLink.vue";
import CitiesLink from "./Links/CitiesLink.vue";
import NeighborhoodsLink from "./Links/NeighborhoodsLink.vue";
import LegalPoliciesLink from "./Links/LegalPoliciesLink.vue";
import LegaltermsLink from "./Links/LegaltermsLink.vue";
import MessagesLink from "./Links/MessagesLink.vue";
import AttributesLink from "./Links/AttributesLink.vue";
import HotelsLink from "@/Layouts/partials/Links/HotelsLink.vue";
</script>
<template>
    <div class="space-y-8">
        <!-- Pages group -->
        <div>
            <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
                <span
                    class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                    aria-hidden="true"
                    >•••</span
                >
                <span class="lg:hidden lg:sidebar-expanded:block 2xl:block"
                    >Pages</span
                >
            </h3>
            <ul class="mt-3">
                <ProfileLink />
                <PropertysLink />
                <HotelsLink/>
                <NotAprrovedPropertysLink />
                <PropertysTrashLink />
                <AttributesLink />
                <MessagesLink />
                <PaginasLink />
                <BannersLink />
                <UsersLink />
                <TransationTypesLink />
                <IntermediationRulesLink />
                <NegociationRulesLink />
                <PropertyConditionsLink />
                <PropertyTypesLink />
                <PropertyStatusLink />
                <ProvincesLink />
                <CitiesLink />
                <NeighborhoodsLink />
            </ul>
            <h3
                class="text-xs uppercase text-slate-500 font-semibold pl-3 mt-2"
            >
                <span
                    class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                    aria-hidden="true"
                    >•••</span
                >
                <span class="lg:hidden lg:sidebar-expanded:block 2xl:block"
                    >Legalidade</span
                >
            </h3>
            <ul class="mt-3">
                <LegalPoliciesLink />
                <LegaltermsLink />
            </ul>
        </div>
    </div>
</template>
